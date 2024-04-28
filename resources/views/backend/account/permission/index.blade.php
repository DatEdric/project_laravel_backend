@extends('backend.layouts.app')
@section('content')
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Permission</h3>

                    <div class="box-tools">
                        <a href="{{ route('get.create.permission') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>
                    </div>
                </div>
                <div class="box-header">

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Group</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        @if($permissions)
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->display_name}}</td>
                                    <td><span class="label label-success">{{$permission->groups->name}}</span></td>
                                    <td>{{$permission->description}}</td>
                                    <td>
                                        <a href="{{ route('get.update.permission',$permission->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('get.delete.permission',$permission->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right" >
                    {{ $permissions->appends($query = '')->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </section>


@endsection
