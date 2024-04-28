@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách sách mượn : {{ $reader->r_name }}</h3>
                </div>
                <div class="box-header">
                    <form action="" class="form-inline">
                        <div class="col-md-12 default">
                            <div class="form-group col-md-4"><input type="text" class="form-control" name="name_book" placeholder="Tên sách" value="{{ Request::get('name_book') }}" style="width: 100%"></div>
                            <div class="form-group col-md-4">
                                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                        <tr>
                            <td colspan="6" class="text-center"> <b>Tổng tiền phạt</b> </td>
                            <td colspan="2" class="text-center"> <b>{{ number_format($forfeit, 0, ',', '.') }}$</b> </td>
                        </tr>
                        <tr>
                            <th style="width: 2%;" class="text-center">STT</th>
                            <th>Tên sách</th>
                            <th>Number</th>
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
                                        <span class="content-space" data-toggle="tooltip" title="{{ $book->book !== null ? $book->book->b_name : '' }}">
                                           {{ $book->book !== null ? $book->book->b_name : '' }}
                                        </span>
                                    </p>
                                </td>
                                <td>{{ $book->d_number }}</td>
                                <td>{{ $book->d_expiry_date }}</td>
                                <td>
                                    <p class="text-space-account">
                                        <span class="content-space" data-toggle="tooltip" title="{{ $book->d_note }}">
                                           {{ $book->d_note }}
                                        </span>
                                    </p>
                                </td>
                                <td>{{ STATUS_BORROW[$book->d_status] }}</td>
                                <td>{{ number_format($book->d_forfeit, 0, ',', '.') }}$</td>
                                <td>
                                    <a href="{{ route('get.update.borrow', $book->d_borrow_id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
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

