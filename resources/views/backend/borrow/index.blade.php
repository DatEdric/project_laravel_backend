@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách mượn</h3>

                    <div class="box-tools">
                        <a href="{{ route('get.create.borrow') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
                    </div>
                </div>
                <div class="box-header">
                    <form action="" class="form-inline">
                        <div class="col-md-12 default">
                            <div class="form-group col-md-4"> <input type="text" class="form-control" name="code_borrow" placeholder="Mã mượn" value="{{ Request::get('code_borrow') }}" style="width: 100%"></div>
                            <div class="form-group col-md-4" >
                                <select name="b_reader_id" class="form-control input_select2" data-type="status" style="width: 100%">
                                    <option value="" >--Chọn độc giả --</option>
                                    @if (isset($readers))
                                        @foreach($readers as $reader)
                                            <option value="{{ $reader->id }}" {{ Request::get('b_reader_id') == $reader->id ? "selected='selected'" : "" }}>{{ $reader->r_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Mã mượn</th>
                            <th>Tên độc giả</th>
                            <th>Chú thích</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                        @if ($borrows)
                            @foreach($borrows as $borrow)
                                <tr>
                                    <td>{{ $borrow->id }}</td>
                                    <td>{{ $borrow->b_code_borrow }}</td>
                                    <td>
                                        <p class="text-space-account">
                                            <span class="content-space" data-toggle="tooltip" title="{{ $borrow->reader !== null ? $borrow->reader->r_name : '' }}">
                                               {{ $borrow->reader !== null ? $borrow->reader->r_name : '' }}
                                            </span>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-space-account">
                                            <span class="content-space" data-toggle="tooltip" title="{{ $borrow->b_note  }}">
                                               {{ $borrow->b_note }}
                                            </span>
                                        </p>
                                    </td>
                                    <td>{{ convertDate($borrow->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('get.ajax.view', $borrow->id) }}" class="btn btn-xs btn-info btn_preview_borrow"><i class="fa fa-fw fa-eye"></i></a>
                                        <a href="{{ route('get.update.borrow', $borrow->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('get.delete.borrow', $borrow->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right" >
                    {{ $borrows->appends($query = '')->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </section>
    <div class="modal modal_borrow fade" id="modal-default">
        <div class="modal-dialog modal-lg" style="width: 750px !important;">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: none; padding-bottom: 0px;">
                </div>
                <div class="modal-header" style="padding-top: 0px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" style="margin-left: 32%; text-transform: uppercase; font-weight: bold;">Thông tin chi tiết thẻ mượn </h4>
                </div>
                <div class="modal-body" id="content_view_borrow">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Đóng</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.mod -->
    </div>
@endsection
