<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::filter($request->all())->paginate(8);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role_id' => ['required', 'integer'],
        ]);

        $user = User::create($request->all());
        $user->roles()->sync([$request->get('role_id')]);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,$user->id"],
            'role_id' => ['required', 'integer'],
        ]);

        $user->fill($request->all())->save();
        $user->roles()->sync([$request->get('role_id')]);

        return redirect()->route('users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index');
    }

    public function profile()
    {
        $user = auth()->user();
        $groups = $user->groups->sortBy('title')->values();
        $activities = $user->activities()
            ->where('date', '>', Carbon::now())
            ->orderBy('date')
            ->get();

        return view('users.profile', compact(
            'user',
            'groups',
            'activities'
        ));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,$user->id"],
        ]);

        if ($request->get('password')) {
            $request->validate([
                'password' => ['required', 'string', 'min:8'],
            ]);
        }

        $user->fill(array_filter($request->all()))->save();

        return redirect()->route('profile');
    }
}
