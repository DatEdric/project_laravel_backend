<?php

namespace App\Http\Controllers\Backend\Account;

use Illuminate\Http\Request;
use App\Http\Requests\RolesRequest;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\GroupPermission;
use Carbon\Carbon;

class AdminRoleController extends Controller
{
    public function __construct()
    {
        view()->share([
            'activeMenu' => 'Role',
        ]);
    }
    public function index()
    {
        $roles = Role::select('*')->with('permissionRole')->orderBy('id', 'DESC')->paginate(10);

        return view('backend.account.role.index', compact('roles'));
    }

    public function create()
    {
        $permissionGroups = GroupPermission::select('*')->with('permissions')->get();
        return view('backend.account.role.create', compact('permissionGroups'));
    }

    public function store(RolesRequest $request)
    {
        $dataRoles['name'] = safeTitle($request->name);
        $dataRoles['display_name'] = $request->name;
        $dataRoles['created_at'] = Carbon::now();
        $dataRoles['updated_at'] = Carbon::now();

        try {
            $id =  Role::insertGetId($dataRoles);

            if ($id) {
                if (!empty($request->permissions)) {
                    foreach ($request->permissions as $permission) {
                        \DB::table('permission_role')->insert(['permission_id' => $permission, 'role_id' => $id]);
                    }
                }
            }
            return redirect()->back()->with('success', 'Thêm mới thành công dữ liệu.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]' . $exception->getMessage());
        }
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $listPermission = \DB::table('permission_role')->where('role_id', $id)->pluck('permission_id')->toArray();
        $permissionGroups = GroupPermission::select('*')->with('permissions')->get();

        if (!$role) {
            return redirect()->route('get.list.role')->with('danger', 'Dữ liệu không tồn tại.');
        }
        $viewData = [
            'listPermission' => $listPermission,
            'permissionGroups' => $permissionGroups,
            'role' => $role,
        ];

        return view('backend.account.role.update', $viewData);
    }

    public function update(RolesRequest $request, $id)
    {
        $dataRoles['name'] = safeTitle($request->name);
        $dataRoles['display_name'] = $request->name;
        $dataRoles['updated_at'] = Carbon::now();

        try {
            Role::findOrFail($id)->update($dataRoles);
            if ($id) {
                \DB::table('permission_role')->where('role_id', $id)->delete();
                if (!empty($request->permissions)) {
                    foreach ($request->permissions as $permission) {
                        \DB::table('permission_role')->insert(['permission_id' => $permission, 'role_id' => $id]);
                    }
                }
            }
            return redirect()->back()->with('success', 'Cập nhật thành công dữ liệu. ');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]' . $exception->getMessage());
        }
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id)->delete();
        if (!$role) {
            return redirect()->route('get.list.role')->with('danger', 'Dữ liệu không tồn tại.');
        }
        $role->delete();
        return redirect()->back()->with('success', 'Xóa thành công dữ liệu');
    }
}
