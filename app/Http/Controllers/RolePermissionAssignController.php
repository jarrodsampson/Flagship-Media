<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RolePermissionAssignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
    	$permissions = Permission::all();
        return view('roles-permissions.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles-permissions.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('type') === 'role') {
    		$permission_values = $request->input('permissions');
	        $validatedData = $this->validator($request->all())->validate();
	        $role = Role::create($validatedData);
	        $role->syncPermissions($permission_values);
	        return redirect('/dashboard/roles-permissions')->with('success', 'Role Successfully Created.');
    	} else {
	        $validatedData = $this->validator($request->all())->validate();
	        Permission::create($validatedData);
	        return redirect('/dashboard/roles-permissions')->with('success', 'Permission Successfully Created.');
    	}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $users = User::role($role->name)->get();

        return view('roles-permissions.edit', compact('role', 'permissions', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->validator($request->all())->validate();
        $permission_values = $request->input('permissions');
        $role = Role::findOrFail($id);
        if ($role->id === 1) {
        	return back()->with('error', 'Admin role cannot be updated.');
        } else {
        	$role->update($validatedData);
	        $role->syncPermissions($permission_values);

	        return redirect('/dashboard/roles-permissions')->with('success', 'Role was successfully updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->input('type') === 'role') {
        	$role = Role::findOrFail($id);
        	if ($role->id === 1) {
            	return back()->with('error', 'You cannot delete the admin role.');
	        } else {
	            $role->delete();
	        	return redirect('/dashboard/roles-permissions')->with('success', 'Role was successfully deleted');
	        }
        } else {
        	$permission = Permission::findOrFail($id);
        	if ($permission->id === 1) {
            	return back()->with('error', 'You cannot delete the main permission.');
	        } else {
	            $permission->delete();
	        	return redirect('/dashboard/roles-permissions')->with('success', 'Permission was successfully deleted');
	        }
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
        ]);
    }
}
