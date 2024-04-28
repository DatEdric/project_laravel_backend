<?php

namespace App\Http\Controllers\Backend\Account;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateInforProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Validator;


class AdminUserController extends Controller
{
    public function __construct()
    {
        view()->share([
            'activeMenu' => 'User',
        ]);
    }
    public function index(Request $request)
    {
        $users = User::with([
            'userRole' => function ($userRole) {
                $userRole->select('*');
            }
        ]);
        if ($request->name) {
            $users = $users->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->email) {
            $users = $users->where('email', $request->email);
        }

        if ($request->phone) {
            $users = $users->where('phone', $request->phone);
        }

        $users = $users->orderBy('id', 'DESC')->paginate(10);

        return view('backend.account.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.account.user.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $data = $request->except('_token', 'password', 'role');
        $data['password'] = bcrypt($request->password);

        try {
            $id =  User::insertGetId($data);
            \DB::table('role_user')->insert(['role_id' => $request->role, 'user_id' => $id]);
            return redirect()->back()->with('success', 'Thêm mới thành công dữ liệu.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]' . $exception->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        $listRoleUser = \DB::table('role_user')->where('user_id', $id)->first();
        $roles = Role::all();

        if (!$user) {
            return redirect()->route('get.list.user')->with('danger', 'Dữ liệu không tồn tại.');
        }

        $viewData = [
            'user' => $user,
            'listRoleUser' => $listRoleUser,
            'roles' => $roles,
        ];
        return view('backend.account.user.update', $viewData);
    }

    public function update(UserUpdateInforProfileRequest $request, $id)
    {

        $data = $request->except('_token');

        try {
            User::find($id)->update($data);
            \DB::table('role_user')->where('user_id', $id)->delete();
            \DB::table('role_user')->insert(['role_id' => $request->role, 'user_id' => $id]);

            return redirect()->back()->with('success', 'Cập nhật thành công dữ liệu. ');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]' . $exception->getMessage());
        }
    }

    public function delete($id)
    {
        if ($id != 1) {
            User::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Xóa thành công dữ liệu');
        } else {
            return redirect()->back()->with('danger', 'Không thể xóa tài khoản quản trị viên');
        }
    }

    public function account()
    {
        $user = User::find(\Auth::user()->id);
        return view('backend.account.user.account', compact('user'));
    }

    public function updateAccount(UserUpdateInforProfileRequest $request, $id)
    {
        $data = $request->except('_token');
        try {

            User::find($id)->update($data);
            return redirect()->back()->with('success', 'Cập nhật thành công dữ liệu. ');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]' . $exception->getMessage());
        }
    }

    public function  changePassword()
    {
        return view('backend.account.password.change');
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        $data['password'] = bcrypt($request->password);

        try {

            User::find(\Auth::user()->id)->update($data);
            \Auth::logout();
            return redirect()->route('login');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]' . $exception->getMessage());
        }
    }
}
