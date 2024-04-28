@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách danh mục</h3>

                    <div class="box-tools">
                        <a href="{{ route('get.create.category') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
                    </div>
                </div>
                <div class="box-header">

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                        @if ($categories)
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->c_name }}</td>
                                    <td>{{ convertDate($category->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('get.update.category', $category->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('get.delete.category', $category->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right" >
                    {{ $categories->appends($query = '')->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection
