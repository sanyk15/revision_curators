<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class StudentController extends Controller
{
    public function index(Request $request, Group $group)
    {
        $filter   = array_merge($request->all(), ['group' => $group->id]);
        $students = Student::filter($filter)->orderBy('last_name')->orderBy('first_name')->get();

        return view('students.index', compact('students', 'group'));
    }

    public function create(Group $group)
    {
        return view('students.create', compact('group'));
    }

    public function store(Request $request, Group $group): RedirectResponse
    {
        $request->validate(Student::$rules);

        if (Arr::get($request->all(), 'is_head')) {
            Student::unsetHeadByGroup($group->id);
        }

        $student = Student::create($request->all());

        return redirect()->route('students.index', ['group' => $student->group_id]);
    }

    public function edit(Group $group, Student $student)
    {
        return view('students.edit', compact('student', 'group'));
    }

    public function update(Request $request, Group $group, Student $student): RedirectResponse
    {
        $request->validate(Student::$rules);

        if (Arr::get($request->all(), 'is_head')) {
            Student::unsetHeadByGroup($group->id);
        }

        $student->fill($request->all())->save();

        return redirect()->route('students.index', ['group' => $student->group_id]);
    }

    public function destroy(Group $group, Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()->back();
    }
}
