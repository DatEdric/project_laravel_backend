@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách nhà xuất bản</h3>

                    <div class="box-tools">
                        <a href="{{ route('get.create.publishing_company') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
                    </div>
                </div>
                <div class="box-header">

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Tên nhà xuất bản</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        @if ($publishingCompany)
                            @foreach($publishingCompany as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>
                                        <p class="text-space-account">
                                            <span class="content-space" data-toggle="tooltip" title="{{$value->pc_name}}">
                                               {{$value->pc_name}}
                                            </span>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-space-account">
                                            <span class="content-space" data-toggle="tooltip" title="{{$value->pc_email}}">
                                               {{$value->pc_email}}
                                            </span>
                                        </p>
                                    </td>
                                    <td>
                                        {{$value->pc_phone}}
                                    </td>
                                    <td>
                                        <p class="text-space-account">
                                            <span class="content-space" data-toggle="tooltip" title="{{$value->pc_address}}">
                                               {{$value->pc_address}}
                                            </span>
                                        </p>
                                    </td>
                                    <td>
                                        @if($value->pc_status == 1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-default">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('get.update.publishing_company', $value->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('get.delete.publishing_company', $value->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right" >
                    {{ $publishingCompany->appends($query = '')->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection
