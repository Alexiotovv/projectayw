<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private function availableRoles()
    {
        $query = Role::orderBy('name');

        if (!auth()->user()->hasRole('superadmin')) {
            $query->where('name', '!=', 'superadmin');
        }

        return $query->get();
    }

    public function __construct()
    {
        $this->middleware(['auth', 'role:superadmin|admin']);
    }

    public function index()
    {
        $users = User::with('roles')->orderByDesc('created_at')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->availableRoles();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:30'],
            'company' => ['nullable', 'string', 'max:255'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:roles,id'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'company' => $request->company,
        ]);

        $roles = Role::whereIn('id', $request->roles ?? [])->get();
        if (!auth()->user()->hasRole('superadmin')) {
            $roles = $roles->where('name', '!=', 'superadmin');
        }
        $user->syncRoles($roles);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $user)
    {
        $roles = $this->availableRoles();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:30'],
            'company' => ['nullable', 'string', 'max:255'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:roles,id'],
        ]);

        if ($user->hasRole('superadmin') && !auth()->user()->hasRole('superadmin')) {
            return back()->with('error', 'No tienes permiso para editar un superadmin.');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->company = $request->company;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $roles = Role::whereIn('id', $request->roles ?? [])->get();
        if (!auth()->user()->hasRole('superadmin')) {
            $roles = $roles->where('name', '!=', 'superadmin');
        }
        $user->syncRoles($roles);

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        if ($user->hasRole('superadmin') && !auth()->user()->hasRole('superadmin')) {
            return back()->with('error', 'No tienes permiso para eliminar un superadmin.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
