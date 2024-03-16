<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityKind;
use App\Models\ActivityType;
use App\Models\Benchmark;
use App\Models\Group;
use App\Models\Indicator;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        return view('activities.index');
    }

    public function create()
    {
        $users = User::query()->curators()->get()->sortBy('short_name')->values();
        $types = ActivityType::query()->get()->sortBy('title');

        if (Auth::user()->hasRole([User::ROLE_CURATOR])) {
            $types = $types->where('code', '=', ActivityType::ADDITIONAL_EVENT_TYPE_CODE);
            $users = $users->where('id', '=', Auth::id());
        }

        return view('activities.create', compact(
            'users',
            'types',
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        (new Activity)->create($request->all());

        return redirect()->route('activities.index');
    }

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        $kinds = ActivityKind::all()->sortBy('title');
        $benchmarks = Benchmark::all()->sortBy('title');
        $groups = Group::all()->sortBy('title');
        $indicators = Indicator::all()->sortBy('title');
        $activity->group_ids = $activity->groups->pluck('id')->toArray();
        $users = User::query()->curators()->get()->sortBy('short_name')->values();

        return view('activities.edit', compact(
            'activity',
            'kinds',
            'benchmarks',
            'groups',
            'indicators',
            'users',
        ));
    }

    public function update(Request $request, Activity $activity): RedirectResponse
    {
        request()->validate(Activity::$rules);

        $activity->update($request->all());
        $activity->groups()->sync($request->get('group_ids'));

        return redirect()->route('activities.index');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();

        return redirect()->route('activities.index');
    }

    public function getActivitiesForMonthByDate(Request $request): string
    {
        $dateStart = Carbon::parse($request->get('start'));
        $dateEnd = Carbon::parse($request->get('end'));

        return Activity::getActivitiesForMonthByPeriod($dateStart, $dateEnd)->toJson();
    }

    public function addGroupsForm(Activity $activity)
    {
        $groups = auth()->user()->groups->sortBy('title')->values();
        $activityGroups = $activity->groups->whereIn('id', $groups->pluck('id')->toArray())->mapWithKeys(function ($group) {
            return [$group->id => $group];
        })->all();

        return view('activities.add-groups', compact(
            'activity',
            'groups',
            'activityGroups',
        ));
    }

    public function addGroups(Request $request, Activity $activity): RedirectResponse
    {
        $activity->groups()->detach(auth()->user()->groups()->pluck('id')->toArray());

        if (!$request->get('group_ids')) {
            return redirect()->route('activities.show', $activity->id);
        }

        $attachGroups = $activity->groups()->get()->mapWithKeys(function ($group) {
            return [$group->id => ['students_count' => $group->pivot->students_count]];
        });

        foreach ($request->get('group_ids') as $id => $studentsCount) {
            if ($studentsCount == 0) {
                continue;
            }

            $attachGroups[$id] = ['students_count' => $studentsCount];
        }

        $activity->groups()->sync($attachGroups->toArray());

        return redirect()->route('activities.show', $activity->id);
    }
}
