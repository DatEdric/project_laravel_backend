@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cập nhật sách</h3>
                        <div class="box-tools">
                            <a href="{{ route('get.create.book') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <!-- form start -->
                    @include('backend.book.form')
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection