@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách sách</h3>

                    <div class="box-tools">
                        <a href="{{ route('get.create.book') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
                    </div>
                </div>
                <div class="box-header">
                    <form action="" class="form-inline">
                        <div class="col-md-12 default">
                            <div class="form-group col-md-4"><input type="text" class="form-control" name="b_name" placeholder="Tên sách" value="{{ Request::get('b_name') }}" style="width: 100%"></div>
                            <div class="form-group col-md-4"> <input type="text" class="form-control" name="b_code_book" placeholder="Mã sách" value="{{ Request::get('b_code_book') }}" style="width: 100%"></div>
                            <div class="form-group col-md-4" >
                                <select name="author_id" class="form-control input_select2" data-type="status" style="width: 100%">
                                    <option value="" >--Chọn tác giả --</option>
                                    @if (isset($authors))
                                        @foreach($authors as $author)
                                            <option value="{{ $author->id }}" {{ Request::get('author_id') == $author->id ? "selected='selected'" : "" }}>{{ $author->at_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4 mg-t-10">
                                <select name="b_categories_id"  class="form-control input_select2" data-type="status" style="width: 100%">
                                    <option value="" >--Chọn danh mục--</option>
                                    @if (isset($categories))
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ Request::get('b_categories_id') == $category->id ? "selected='selected'" : "" }}>{{ $category->c_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4 mg-t-10">
                                <select name="b_publishing_company_id"  class="form-control input_select2" data-type="status" style="width: 100%">
                                    <option value="" >--Chọn nhà xuất bản--</option>
                                    @if (isset($publishingCompany))
                                        @foreach($publishingCompany as $company)
                                            <option value="{{ $company->id }}" {{ Request::get('b_publishing_company_id') == $company->id ? "selected='selected'" : "" }}>{{ $company->pc_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4 mg-t-10">
                                <select name="b_status" class=" form-control" data-type="b_status" style="width: 100%">
                                    <option value="" >--Chọn trạng thái--</option>
                                    <option value="1" {{ Request::get('b_status') == 1 ? "selected='selected'" : "" }}>Hoạt động</option>
                                    <option value="2" {{ Request::get('b_status') == 2 ? "selected='selected'" : "" }}>Tạm ngưng</option>
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
                        <tbody><tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Mã sách</th>
                            <th>Danh mục</th>
                            <th>Nhà xuất bản</th>
                            <th>Tác giả</th>
                            <th>Số lượng</th>
                            <th>Số lượng đã thanh lý</th>
                            <th>Giá</th>
                            <td>Trạng thái</td>
                            <th>Hành động</th>
                        </tr>
                        @if ($books)
                            @foreach($books as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>
                                        <p class="text-space-account">
                                            <span class="content-space" data-toggle="tooltip" title="{{$book->b_name}}">
                                               {{$book->b_name}}
                                            </span>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-space-account">
                                            <span class="content-space" data-toggle="tooltip" title="{{$book->b_code_book}}">
                                               {{$book->b_code_book}}
                                            </span>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-space-account">
                                            <span class="content-space" data-toggle="tooltip" title="{{ $book->categories !== null ? $book->categories->c_name : '' }}">
                                               {{ $book->categories !== null ? $book->categories->c_name : '' }}
                                            </span>
                                        </p>
                                    </td>

                                    <td>
                                        <p class="text-space-account">
                                            <span class="content-space" data-toggle="tooltip" title="{{ $book->publishingCompany !== null ? $book->publishingCompany->pc_name : '' }}">
                                               {{ $book->publishingCompany !== null ? $book->publishingCompany->pc_name : '' }}
                                            </span>
                                        </p>
                                    </td>
                                    <td>
                                        @if(!empty($book->authorBook))
                                            @foreach($book->authorBook as $author)
                                                <span class="label label-success" style="line-height: 2;">{{$author->at_name}}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @php $numberAmount = $book->ib_amount; @endphp
                                        @if(!empty($book->amount))
                                            @php
                                                foreach($book->amount as $amount) {
                                                    $numberAmount = $numberAmount + $amount->ib_amount;
                                                }
                                            @endphp
                                        @endif
                                        @php
                                            $numberExport = $book->orders->sum('d_number');
                                        @endphp
                                        @if(isset($numberAmount))
                                            @php $number = $numberAmount - ($numberExport + $book->b_amount_liquidated); @endphp
                                            {{ $number > 0 ? $number : 0 }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td>{{ $book->b_amount_liquidated !== NULL ? $book->b_amount_liquidated : 0  }}</td>
                                    <td>{{ !empty($book->b_price) ? number_format($book->b_price, 0, ',', '.') . 'vnđ' : '' }}</td>
                                    <td>
                                        @if($book->b_status == 1)
                                            <span class="label label-success">Hoạt động</span>
                                        @else
                                            <span class="label label-default">Tạm ngưng</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('get.update.book', $book->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('get.delete.book', $book->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                        <a href="{{ route('get.list.import_books', $book->id) }}" class="btn btn-xs btn-info"><i class="fa fa-fw fa-cloud-upload"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
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
@endsection
