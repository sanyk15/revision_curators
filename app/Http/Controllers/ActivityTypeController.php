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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ActivityTypeController extends Controller
{
    public function index(Request $request)
    {
        $activityTypes = ActivityType::filter($request->all())->orderBy('title')->paginate(8);

        return view('activity_types.index', compact('activityTypes'));
    }

    public function create()
    {
        $kinds = ActivityKind::all()->sortBy('title');
        $benchmarks = Benchmark::all()->sortBy('title');
        $groups = Group::all()->sortBy('title');
        $indicators = Indicator::all()->sortBy('title');

        return view('activity_types.create', compact(
            'kinds',
            'benchmarks',
            'groups',
            'indicators',
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        request()->validate(ActivityType::$rules);

        $type = (new ActivityType)->create($request->all());
        $type->code = Str::slug($type->title);
        $type->save();

        return redirect()->route('activity_types.index');
    }

    public function show(ActivityType $activityType)
    {
        return view('activity_types.show', compact('activityType'));
    }

    public function edit(ActivityType $activityType)
    {
        $kinds = ActivityKind::all()->sortBy('title');
        $benchmarks = Benchmark::all()->sortBy('title');
        $groups = Group::all()->sortBy('title');
        $indicators = Indicator::all()->sortBy('title');

        return view('activity_types.edit', compact(
            'activityType',
            'kinds',
            'benchmarks',
            'groups',
            'indicators',
        ));
    }

    public function update(Request $request, ActivityType $activityType): RedirectResponse
    {
        request()->validate(ActivityType::$rules);

        $activityType->update($request->all());
        $activityType->code = Str::slug($activityType->title);
        $activityType->save();

        return redirect()->route('activity_types.index');
    }

    public function destroy(ActivityType $activityType): RedirectResponse
    {
        $activityType->delete();

        return redirect()->route('activity_types.index');
    }
}
