<?php

namespace App\Http\Controllers\Backend\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Models\GroupPermission;

class AdminPermissionController extends Controller
{
    public function __construct()
    {
        view()->share([
            'activeMenu' => 'Permission',
        ]);
    }
    //
    public function index()
    {
        $permissions = Permission::with([
            'groups' => function ($groups) {
                $groups->select('id', 'name');
            }
        ])->orderBy('id', 'DESC')->paginate(10);

        return view('backend.account.permission.index', compact('permissions'));
    }

    //
    public function create()
    {
        $permissionGroups = GroupPermission::all();
        return view('backend.account.permission.create', compact('permissionGroups'));
    }

    //
    public function store(PermissionRequest $request)
    {
        $this->createOrUpdate($request);
        return redirect()->back()->with('success', 'Thêm mới thành công dữ liệu.');
    }

    //
    public function edit($id)
    {
        $permissionGroups = GroupPermission::all();
        $permission = Permission::findOrFail($id);

        if (!$permission) {
            return redirect()->route('get.list.permission')->with('danger', 'Dữ liệu không tồn tại.');
        }

        return view('backend.account.permission.update', compact('permission', 'permissionGroups'));
    }
    //

    public function update(PermissionRequest $request, $id)
    {
        $this->createOrUpdate($request, $id);
        return redirect()->route('get.list.permission')->with('success', 'Cập nhật thành công dữ liệu.');
    }

    //
    public function delete($id)
    {
        $permission = Permission::findOrFail($id);
        if (!$permission) {
            return redirect()->route('get.list.permission')->with('danger', 'Dữ liệu không tồn tại.');
        }
        $permission->delete();
        return redirect()->back()->with('success', 'Xóa thành công dữ liệu');
    }

    //
    public function createOrUpdate($request, $id = '')
    {
        $permission = new Permission();

        if ($id) {
            $permission = Permission::findOrFail($id);
        }

        $permission->name                       = safeTitle($request->name);
        $permission->display_name               = $request->name;
        $permission->group_permission_id        = $request->group_permission_id;
        $permission->description                = $request->description;

        $permission->save();
    }
}
