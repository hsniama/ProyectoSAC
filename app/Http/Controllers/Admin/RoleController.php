<?php

namespace App\Http\Controllers\Admin; //Modifico esta

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // yo agregue esta
use Spatie\Permission\Models\Role; // yo agregue esta
use Spatie\Permission\Models\Permission; // yo agregue esta
use Illuminate\Support\Facades\DB; // yo agregue esta

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:role-list')->only('index');
        $this->middleware('can:role-create')->only('create', 'store');
        $this->middleware('can:role-edit')->only('edit', 'update');
        $this->middleware('can:role-delete')->only('destroy');
        $this->middleware('can:role-show')->only('show');
    }

    public function index()
    {
        // $roles = Role::all(); Da problema con duplicidad de datos y n+1.
        $roles = Role::with('permissions')->get();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        //$permissions = Permission::get();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:roles,name', 'alpha_num', 'max:20', 'string'],
            'permissions' => 'required', 'exists:permissions,id',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol creado existosamente');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('admin.roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'alpha_num', 'max:20', 'string'],
            'permissions' => 'required', 'exists:permissions,id',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol actualizado existosamente');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        
        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol eliminado existosamente');
    }
}
