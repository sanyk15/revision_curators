<?php

namespace App\Reports;

use App\Models\Activity;
use App\Models\AdditionalEvent;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CuratorActivitiesReport implements FromView, ShouldAutoSize
{
    private $activities;
    private $date;

    public function __construct(Collection $activities, Carbon $date)
    {
        $this->activities = $activities;
        $this->date = $date;
    }

    public function view(): View
    {
        $curatorsWithGroups = collect();
        $i = 0;
        $j = 0;
        $k = 0;
        $activities = $this->activities
            ->map(function (Activity $activity) use (&$curatorsWithGroups) {
                $activity->curator_name = $activity->curator->surname_and_initials;
                $activity->group_name = $activity->group->title;

                $curatorsWithGroups->push([
                    'curator' => $activity->curator_name,
                    'group'   => $activity->group_name,
                    'score'   => $this->activities
                        ->where('curator_id', $activity->curator_id)
                        ->where('group_id', $activity->group_id)
                        ->sum('curator_score'),
                ]);

                return $activity;
            })
            ->groupBy(['activityKind.title', 'benchmark.title', 'indicator.title']);
        $curatorsWithGroups = $curatorsWithGroups->unique(function ($item) {
            return data_get($item, 'curator') . data_get($item, 'group');
        })->sortBy(['curator', 'group']);
        $activities = $activities->map(function ($activitiesForKind, $kindName) use (&$i, &$j, &$k, $curatorsWithGroups) {
            $i++;

            $activitiesForKind = $activitiesForKind->map(function ($activitiesForBenchmark, $benchmarkName) use (&$i, &$j, &$k, $curatorsWithGroups) {
                $j++;

                $activitiesForBenchmark = $activitiesForBenchmark->map(function ($activitiesForIndicator, $indicatorName) use (&$i, &$j, &$k, $curatorsWithGroups) {
                    $k++;
                    $scores = [];

                    foreach ($curatorsWithGroups as $item) {
                        $scores[] = $activitiesForIndicator->where('curator_name', data_get($item, 'curator'))
                            ->where('group_name', data_get($item, 'group'))
                            ->sum('curator_score');
                    }

                    return [
                        'name'                 => $indicatorName ? "$i.$j.$k $indicatorName" : '',
                        'threshold'            => $activitiesForIndicator->pluck('threshold')->filter()->first(),
                        'assessment_frequency' => $activitiesForIndicator->pluck('assessment_frequency')->filter()->first(),
                        'possible_score'       => $activitiesForIndicator->pluck('possible_score')->filter()->first(),
                        'scores'               => $scores,
                    ];
                });

                return [
                    'name'    => $benchmarkName ? "$i.$j $benchmarkName" : '',
                    'rowspan' => count($activitiesForBenchmark),
                    'items'   => $activitiesForBenchmark->values(),
                ];
            });

            return collect([
                'number'  => $i,
                'name'    => $kindName,
                'rowspan' => $activitiesForKind->sum('rowspan'),
                'items'   => $activitiesForKind->values(),
            ]);
        })->values();

        return view('reports.curators_report', [
            'activities'           => $activities,
            'date'                 => $this->date,
            'curators_with_groups' => $curatorsWithGroups,
            'additional_events' => AdditionalEvent::query()
                ->whereBetween('date', [$this->date->copy()->startOfMonth(), $this->date->copy()->endOfMonth()])
                ->orderBy('title')
                ->get(),
        ]);
    }
}
