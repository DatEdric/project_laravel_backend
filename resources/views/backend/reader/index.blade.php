@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách độc giả</h3>

                    <div class="box-tools">
                        <a href="{{ route('get.create.reader') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                    </div>
                </div>
                <div class="box-header">
                    <form action="" class="form-inline">
                        <div class="col-md-12 default">
                            <div class="form-group col-md-4"><input type="text" class="form-control" name="r_name" placeholder="Họ và tên" value="{{ Request::get('r_name') }}" style="width: 100%"></div>
                            <div class="form-group col-md-4"> <input type="text" class="form-control" name="code_card" placeholder="Mã thẻ" value="{{ Request::get('code_card') }}" style="width: 100%"></div>
                            <div class="form-group col-md-4"> <input type="date" class="form-control" name="r_birthday" placeholder="Ngày sinh" value="{{ Request::get('r_birthday') }}" style="width: 100%"></div>
                            <div class="form-group col-md-4 mg-t-10" >
                                <select name="r_department_id" class="form-control input_select2" data-type="status" style="width: 100%">
                                    <option value="" >--Chọn khối lớp--</option>
                                    @if (isset($departments))
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ Request::get('r_department_id') == $department->id ? "selected='selected'" : "" }}>{{ $department->d_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4 mg-t-10">
                                <select name="r_class_id"  class="form-control input_select2" data-type="status" style="width: 100%">
                                    <option value="" >--Chọn lớp--</option>
                                    @if (isset($class))
                                        @foreach($class as $value)
                                            <option value="{{ $value->id }}" {{ Request::get('r_class_id') == $value->id ? "selected='selected'" : "" }}>{{ $value->c_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4 mg-t-10">
                                <select name="r_gender" class=" form-control" data-type="r_gender" style="width: 100%">
                                    <option value="" >--Chọn giới tính--</option>
                                    <option value="1" {{ Request::get('r_gender') == 1 ? "selected='selected'" : "" }}>Nam</option>
                                    <option value="2" {{ Request::get('r_gender') == 2 ? "selected='selected'" : "" }}>Nữ</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 mg-t-10 text-center">
                                <button type="submit" class="btn btn-info" style="width: 371px;"><i class="fa fa-search"></i> Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Khối lớp</th>
                                <th>Lớp</th>
                                <th>Mã thẻ</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>

                            @if($readers)
                                @foreach($readers as $reader)
                                    <tr>
                                        <td>{{$reader->id}}</td>
                                        <td>
                                            <p class="text-space-account">
                                                <span class="content-space" data-toggle="tooltip" title="{{$reader->r_name}}">
                                                   {{$reader->r_name}}
                                                </span>
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-space-account">
                                                <span class="content-space" data-toggle="tooltip" title="{{ $reader->department !== null ? $reader->department->d_name : '' }}">
                                                   {{ $reader->department !== null ? $reader->department->d_name : '' }}
                                                </span>
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-space-account">
                                                <span class="content-space" data-toggle="tooltip" title="{{ $reader->class !== null ? $reader->class->c_name : '' }}">
                                                   {{ $reader->class !== null ? $reader->class->c_name : '' }}
                                                </span>
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-space-account">
                                                <span class="content-space" data-toggle="tooltip" title="{{$reader->r_code_card}}">
                                                   {{$reader->r_code_card}}
                                                </span>
                                            </p>
                                        </td>
                                        <td>{{ $reader->r_gender == 1 ? 'Male' : 'Female' }}</td>
                                        <td>{{ $reader->r_birthday }}</td>
                                        <td>
                                            @if($reader->r_status == 1)
                                                <span class="label label-success">Hoạt động</span>
                                            @else
                                                <span class="label label-default">Tạm ngưng</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('get.update.reader', $reader->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('get.preview.card', $reader->id) }}" class="btn btn-xs btn-info btn_preview_card"><i class="fa fa-fw fa-credit-card"></i></a>
                                            <a href="{{ route('get.list.reader.book', $reader->id) }}" class="btn btn-xs btn-info"><i class="fa fa-fw fa-book"></i></a>
                                            <a href="{{ route('get.delete.reader', $reader->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right" >
                    {{ $readers->appends($query = '')->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </section>

    <div class="modal card_preview fade" id="modal-default">
        <div class="modal-dialog modal-lg" style="width: 500px !important;">
            <div class="modal-content">
                <div class="modal-header" style="padding-top: 0px; text-align: center;">
                    <h4 class="modal-title" style="text-transform: uppercase; font-weight: bold; margin-top: 15px;">THẺ THƯ VIỆN</h4>
                </div>
                <div class="modal-body" id="card_preview">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Đóng</button>
                    {{--<button type="button" class="btn bg-green pull-right mg-r-5" data-dismiss="modal" onclick="js:window.print()"><i class="fa fa-fw fa-print"></i> In</button>--}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.mod -->
    </div>
@endsection
@section('script')
@endsection

