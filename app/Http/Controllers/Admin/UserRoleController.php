<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:superadmin|admin']);
    }

    public function index()
    {
        $users = User::with('roles')->orderBy('name')->paginate(20);
        return view('admin.users.roles', compact('users'));
    }

    public function edit(User $user)
    {
        $roles           = Role::orderBy('name')->get();
        $permissions     = Permission::orderBy('name')->get();
        $userRoles       = $user->roles->pluck('id')->toArray();
        $userPermissions = $user->getDirectPermissions()->pluck('id')->toArray();

        return view('admin.users.edit_roles', compact('user', 'roles', 'permissions', 'userRoles', 'userPermissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'roles'       => ['nullable', 'array'],
            'roles.*'     => ['exists:roles,id'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        // Evitar modificar al propio superadmin si no eres superadmin
        if ($user->hasRole('superadmin') && ! auth()->user()->hasRole('superadmin')) {
            return back()->with('error', 'No tienes permiso para modificar a un superadmin.');
        }

        $roles = Role::whereIn('id', $request->roles ?? [])->get();
        $user->syncRoles($roles);

        $perms = Permission::whereIn('id', $request->permissions ?? [])->get();
        $user->syncPermissions($perms);

        return redirect()->route('admin.users.roles')
            ->with('success', 'Roles y permisos de "' . $user->name . '" actualizados.');
    }
}
