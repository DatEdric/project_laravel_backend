@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách sách mượn </h3>
                </div>
                <div class="box-header">
                    <form action="" class="form-inline">
                        <div class="col-md-12 default">
                            <div class="form-group col-md-3"><input type="text" class="form-control" name="name_book" placeholder="Tên sách" value="{{ Request::get('name_book') }}" style="width: 100%"></div>
                            <div class="form-group col-md-3"> <input type="text" class="form-control" name="name_reader" placeholder="Tên độc giả" value="{{ Request::get('name_reader') }}" style="width: 100%"></div>
                            <div class="form-group col-md-3"> <input type="date" class="form-control" name="d_expiry_date" placeholder="Ngày hết hạn" value="{{ Request::get('d_expiry_date') }}" style="width: 100%"></div>
                            <div class="form-group col-md-3">
                                <select name="d_status" class=" form-control" data-type="r_gender" style="width: 100%">
                                    <option value="" ></option>
                                    <option value="2" {{ Request::get('d_status') == 2 ? "selected='selected'" : "" }}>Đã trả</option>
                                    <option value="3" {{ Request::get('d_status') == 3 ? "selected='selected'" : "" }}>Đã mất</option>
                                    <option value="4" {{ Request::get('d_status') == 4 ? "selected='selected'" : "" }}>Trả muộn</option>
                                    <option value="5" {{ Request::get('d_status') == 5 ? "selected='selected'" : "" }}>Đang mượn</option>
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
                            <th style="width: 2%;" class="text-center">STT</th>
                            <th>Tên độc giả</th>
                            <th>Tên sách</th>
                            <th>Number</th>
                            <th>Ngày tạo</th>
                            <th>Ngày hết hạn</th>
                            <th>Chú thích</th>
                            <th>Trạng thái</th>
                            <th>Tiền phạt</th>
                            <th>Hành động</th>
                        </tr>
                        @foreach($books as $key => $book)
                            <tr @if(getDay($book->d_expiry_date) < 0 && $book->d_status == 1)) style="background-color: #c6c6c6;" title="Payment is overdue" @endif>
                                <td style="width: 2%;">{{ $key + 1 }}</td>
                                <td>
                                    <p class="text-space-account">
                                        <span class="content-space" data-toggle="tooltip" title="{{ $book->reader !== null ? $book->reader->r_name : '' }}">
                                           {{ $book->reader !== null ? $book->reader->r_name : '' }}
                                        </span>
                                    </p>
                                </td>
                                <td>
                                    <p class="text-space-account">
                                        <span class="content-space" data-toggle="tooltip" title="{{ $book->book !== null ? $book->book->b_name : '' }}">
                                           {{ $book->book !== null ? $book->book->b_name : '' }}
                                        </span>
                                    </p>
                                </td>
                                <td>{{ $book->d_number }}</td>
                                <td>{{ convertDate($book->created_at) }}</td>
                                <td>{{ $book->d_expiry_date }}</td>
                                <td>
                                    <p class="text-space-account">
                                        <span class="content-space" data-toggle="tooltip" title="{{ $book->d_note }}">
                                           {{ $book->d_note }}
                                        </span>
                                    </p>
                                </td>
                                <td>{{ STATUS_BORROW[$book->d_status] }}</td>
                                <td>{{ number_format($book->d_forfeit, 0, ',', '.') }}vnđ</td>
                                <td>
                                    <a href="{{ route('get.update.borrow', $book->d_borrow_id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('get.delete.orders', $book->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right" >
                    {{ $books->appends($query = '')->links() }}
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
                    {{--<button type="button" class="btn bg-green pull-right mg-r-5" data-dismiss="modal" onclick="js:window.print()"><i class="fa fa-fw fa-print"></i> Print</button>--}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.mod -->
    </div>
@endsection
@section('script')
@endsection

