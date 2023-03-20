<?php

namespace App\Http\Controllers;

use App\Models\ActivityKind;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ActivityKindController extends Controller
{
    public function index(Request $request)
    {
        $activityKinds = ActivityKind::filter($request->all())->orderBy('title')->paginate(8);

        return view('activity_kinds.index', compact('activityKinds'));
    }

    public function create()
    {
        return view('activity_kinds.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
        ]);

        ActivityKind::create($request->all());

        return redirect()->route('activity_kinds.index');
    }

    public function edit(ActivityKind $activityKind)
    {
        return view('activity_kinds.edit',compact('activityKind'));
    }

    public function update(Request $request, ActivityKind $activityKind): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
        ]);

        $activityKind->fill($request->all())->save();

        return redirect()->route('activity_kinds.index');
    }

    public function destroy(ActivityKind $activityKind): RedirectResponse
    {
        $activityKind->delete();

        return redirect()->route('activity_kinds.index');
    }
}
