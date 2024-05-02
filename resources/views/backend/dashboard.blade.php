@extends('backend.layouts.app')
@section('content')
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $amountReader > 0 ? $amountReader : 0 }}</h3>

                    <p>Độc giả</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('get.list.reader')}}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$totalBook > 0 ? $totalBook  : 0}}</h3>

                    <p>Sách</p>
                </div>
                <div class="icon">
                    <i class="fa fa-fw fa-book"></i>
                </div>
                <a href="{{ route('get.list.book') }}" class="small-box-footer">Xem thêm<i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $totalBookLiquidated > 0 ? $totalBookLiquidated : 0 }}</h3>

                    <p>Tổng sách đã thanh lý</p>
                </div>
                <div class="icon">
                    <i class="fa fa-fw fa-book"></i>
                </div>
                <a href="{{ route('get.list.book') }}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $totalBookBorrowing > 0 ? $totalBookBorrowing : 0 }}</h3>

                    <p>Tổng sách đang mượn</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('get.list.borrow.book') }}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6">
            <div class="box my-custom-scrollbar" style="height: 300px;">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-sm" id="imported_books">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Tên sách</th>
                            <th>Số lượng</th>
                            <th>Số phát hành</th>
                            <th>Tạo</th>
                        </tr>
                        @if($newImportBook)
                        @foreach($newImportBook as $key => $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>
                                <p class="text-space-account">
                                    <span class="content-space" data-toggle="tooltip" title="{{ isset($book->book) ? $book->book->b_name : '' }}">
                                        {{ isset($book->book) ? $book->book->b_name : '' }}
                                    </span>
                                </p>
                            </td>
                            <td>{{ $book->ib_amount }}</td>
                            <td>{{ $book->ib_issue_number }}</td>
                            <td>{{ convertDate($book->created_at) }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box my-custom-scrollbar" style="height: 300px;">
                <div class="box-header with-border">
                    <h3 class="box-title">Độc giả vi phạm</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Tên độc giả</th>
                            <th>Tên sách</th>
                            <th>Ngày hết hạn</th>
                            <th>Trạng thái</th>
                            <th>Tiền phạt</th>
                        </tr>
                        @if($readersViolated)
                        @foreach($readersViolated as $key => $reader)
                        <tr>
                            <td>{{ $reader->id }}</td>
                            <td>
                                <p class="text-space-account">
                                    <span class="content-space" data-toggle="tooltip" title="{{ isset($reader->reader) ? $reader->reader['r_name'] : '' }}">
                                        {{ isset($reader->reader) ? $reader->reader['r_name'] : '' }}
                                    </span>
                                </p>
                            </td>
                            <td>
                                <p class="text-space-account">
                                    <span class="content-space" data-toggle="tooltip" title="{{ isset($reader->book) ? $reader->book->b_name : '' }}">
                                        {{ isset($reader->book) ? $reader->book->b_name : '' }}
                                    </span>
                                </p>
                            </td>
                            <td>{{ $reader->d_expiry_date }}</td>
                            <td>{{ STATUS_BORROW[$reader->d_status] }}</td>
                            <td>{{ number_format($reader->d_forfeit, 0, ',', '.') }} vnđ</td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box my-custom-scrollbar" style="height: 300px;">
                <div class="box-header with-border">
                    <h3 class="box-title">Độc giả đang mượn</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Tên độc giả</th>
                            <th>Tên sách</th>
                            <th>Ngày hết hạn</th>
                            <th>Ngày tạo</th>
                        </tr>
                        @if($readersBorrowing)
                        @foreach($readersBorrowing as $key => $borrow)
                        <tr>
                            <td>{{ $borrow->id }}</td>
                            <td>
                                <p class="text-space-account">
                                    <span class="content-space" data-toggle="tooltip" title="{{ isset($borrow->reader) ? $borrow->reader['r_name'] : '' }}">
                                        {{ isset($borrow->reader) ? $borrow->reader['r_name'] : '' }}
                                    </span>
                                </p>
                            </td>
                            <td>
                                <p class="text-space-account">
                                    <span class="content-space" data-toggle="tooltip" title="{{ isset($borrow->book) ? $borrow->book->b_name : '' }}">
                                        {{ isset($borrow->book) ? $borrow->book->b_name : '' }}
                                    </span>
                                </p>
                            </td>
                            <td>{{ $borrow->d_expiry_date }}</td>
                            <td>{{ convertDate($book->created_at) }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- /.box -->
</section>
<!-- /.content -->

@endsection
@section('script')

@endsection
