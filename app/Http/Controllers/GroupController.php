<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $groups = Group::filter($request->all())->orderBy('title')->paginate(8);

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
        ]);

        Group::create($request->all());

        return redirect()->route('groups.index');
    }

    public function edit(Group $group)
    {
        return view('groups.edit',compact('group'));
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

        return redirect()->route('groups.index');
    }
}
