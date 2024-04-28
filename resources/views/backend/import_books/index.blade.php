@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Import Sách</h3>
                </div>
                <div class="box-header">
                    <form action="{{ route('post.create.import_books', $id) }}" method="post" class="form-inline">
                        <div class="col-md-12 default">
                            <div class="form-group col-md-6 pd-l-default {{ $errors->first('ib_amount') ? 'has-error' : '' }}">
                                <label for="inputEmail3" class="control-label default">Số lượng<sup class="title-sup"> (*)</sup></label>
                                <input type="text" class="form-control" name="ib_amount" placeholder="Số lượng" value="" style="width: 100%">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('ib_amount') }}</p></span>
                            </div>
                            <div class="form-group col-md-6 pd-l-default">
                                <label for="inputEmail3" class="control-label default">Số phát hành </label>
                                <input type="text" class="form-control" name="ib_issue_number" placeholder="Issue Number" value="" style="width: 100%">
                            </div>
                            <div class="form-group col-md-12 mg-t-10 text-center">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu</button>
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
                            <th>Số lượng</th>
                            <th>Số phát hành</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                        @if ($listImportBook)
                            @foreach($listImportBook as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>
                                        <p class="text-space-account">
                                            <span class="content-space" data-toggle="tooltip" title="{{ $book->book !== null ? $book->book->b_name : '' }}">
                                               {{ $book->book !== null ? $book->book->b_name : '' }}
                                            </span>
                                        </p>
                                    </td>
                                    <td>{{ $book->ib_amount }}</td>
                                    <td>{{ $book->ib_issue_number }}</td>
                                    <td>{{ convertDate($book->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('get.delete.import_books', $book->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right" >
                    {{--{{ $classs->appends($query = '')->links() }}--}}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection
