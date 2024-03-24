<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $groups = Group::filter($request->all())->orderBy('title')->paginate(8);

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $users = User::all()->sortBy('short_name')->values();

        return view('groups.create', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
        ]);

        $attributes = $request->all();

        if (!Arr::has($attributes, 'user_id')) {
            $attributes['user_id'] = auth()->id();
        }

        Group::create($attributes);

        return redirect()->route('groups.index');
    }

    public function edit(Group $group)
    {
        $users = User::all()->sortBy('short_name')->values();

        return view('groups.edit',compact('group', 'users'));
    }

    public function update(Request $request, Group $group): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
        ]);

        $group->fill($request->all())->save();

        return redirect()->route('groups.index');
    }

    public function destroy(Group $group): RedirectResponse
    {
        $group->delete();

        return redirect()->back();
    }

    public function nextCourse(Group $group): RedirectResponse
    {
        $group->translateToNextCourse();

        return redirect()->back();
    }
}
