@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách người dùng</h3>

                    <div class="box-tools">
                        <a href="{{ route('get.create.user') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
                    </div>
                </div>
                <div class="box-header">
                    <div class="pull-left">
                        <form action="" class="form-inline">
                            <input type="text" class="form-control" name="name" placeholder="Tên" value="{{ Request::get('name') }}">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ Request::get('email') }}">
                            <input type="text" class="form-control" name="phone" placeholder="Số điện thọai" value="{{ Request::get('phone') }}">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Tìm kiếm</button>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Phân quyền</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            @if($users)
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>
                                            <p class="text-space-account">
                                                <span class="content-space" data-toggle="tooltip" title="{{$user->name}}">
                                                   {{$user->name}}
                                                </span>
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-space-account">
                                                <span class="content-space" data-toggle="tooltip" title="{{$user->email}}">
                                                   {{$user->email}}
                                                </span>
                                            </p>
                                        </td>
                                        <td>{{$user->phone}}</td>
                                        <td>
                                            @if($user->userRole != null)
                                                @foreach($user->userRole as $role)
                                                    <span class="label label-success">{{$role->display_name}}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->status)
                                                <span class="label label-success">Hoạt động</span>
                                            @else
                                                <span class="label label-default">Tạm ngưng</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('get.update.user',$user->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('get.delete.user',$user->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right" >
                    {{ $users->appends($query = '')->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection