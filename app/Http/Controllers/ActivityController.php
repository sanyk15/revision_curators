<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityKind;
use App\Models\Benchmark;
use App\Models\Curator;
use App\Models\Group;
use App\Models\Indicator;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::paginate(8);

        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        $kinds = ActivityKind::all()->sortBy('title');
        $benchmarks = Benchmark::all()->sortBy('title');
        $curators = Curator::all()->sortBy('surname_and_initials');
        $groups = Group::all()->sortBy('title');
        $indicators = Indicator::all()->sortBy('title');

        return view('activities.create', compact(
            'kinds',
            'benchmarks',
            'curators',
            'groups',
            'indicators',
        ));
    }

    public function store(Request $request)
    {
        request()->validate(Activity::$rules);

        Activity::create($request->all());

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
        $curators = Curator::all()->sortBy('surname_and_initials');
        $groups = Group::all()->sortBy('title');
        $indicators = Indicator::all()->sortBy('title');

        return view('activities.edit', compact(
            'activity',
            'kinds',
            'benchmarks',
            'curators',
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
}
