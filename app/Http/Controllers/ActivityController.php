<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityKind;
use App\Models\Benchmark;
use App\Models\Group;
use App\Models\Indicator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        return view('activities.index');
    }

    public function create()
    {
        $kinds = ActivityKind::all()->sortBy('title');
        $benchmarks = Benchmark::all()->sortBy('title');
        $groups = Group::all()->sortBy('title');
        $indicators = Indicator::all()->sortBy('title');

        return view('activities.create', compact(
            'kinds',
            'benchmarks',
            'groups',
            'indicators',
        ));
    }

    public function store(Request $request)
    {
        request()->validate(Activity::$rules);

        $attributes = $request->all();
        $attributes['user_id'] = Auth::id();

        Activity::create($attributes);

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

        return view('activities.edit', compact(
            'activity',
            'kinds',
            'benchmarks',
            'groups',
            'indicators',
        ));
    }

    public function update(Request $request, Activity $activity)
    {
        request()->validate(Activity::$rules);

        $activity->update($request->all());

        return redirect()->route('activities.index');
    }

    public function destroy(Activity $activity)
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
}
