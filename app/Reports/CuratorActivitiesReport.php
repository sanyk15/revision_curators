<?php

namespace App\Reports;

use App\Models\Activity;
use App\Models\ActivityType;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CuratorActivitiesReport implements FromView, WithStyles, ShouldAutoSize, WithColumnWidths
{
    private Collection $activities;
    private Carbon     $date;
    private ?int       $rows;

    public function __construct(Collection $activities, Carbon $date)
    {
        $this->activities = $activities;
        $this->date       = $date;
    }

    public function view(): View
    {
        $curatorsWithGroups = collect();

        $i = 0;
        $j = 0;
        $k = 0;

        $activities = $this->activities
            ->map(function (Activity $activity) use (&$curatorsWithGroups) {
                $activity->curator_name = $activity->user->surname_and_initials;
                $activity->groups_names = implode(', ', $activity->groups->pluck('title')->toArray());

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

        $this->rows = $activities->sum('rowspan');

        return view('reports.curators_report', [
            'activities'           => $activities,
            'date'                 => $this->date,
            'curators_with_groups' => $curatorsWithGroups,
            'additional_events'    => Activity::query()
                ->whereHas('type', function ($query) {
                    $query->where('code', '=', ActivityType::ADDITIONAL_EVENT_TYPE_CODE);
                })
                ->whereBetween('date', [$this->date->copy()->startOfMonth(), $this->date->copy()->endOfMonth()])
                ->orderBy('title')
                ->get(),
        ]);
    }

    public function styles(Worksheet $sheet): array
    {
        $styles = [];

        for ($i = 1; $i <= 6 + $this->rows; $i++) {
            $styles[$i] = ['alignment' => ['wrapText' => true]];
        }

        return $styles;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 17,
            'C' => 17,
            'D' => 17,
            'E' => 17,
            'F' => 17,
            'G' => 17,
        ];
    }
}
