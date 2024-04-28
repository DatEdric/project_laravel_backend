@extends('backend.layouts.app')
@section('script_edit_news')
<script src="{!! asset('admin/ckeditor/ckeditor.js') !!}"></script>
<script src="{!! asset('admin/ckfinder/ckfinder.js') !!}"></script>
<script src="{!! asset('admin/js/func_ckfinder.js') !!}"></script>
<script>
    var baseURL = "{!! url('/')!!}"
</script>
@endsection
@section('content')
    <style>
        #cke_1_contents {
            min-height: 500px !important;
        }
    </style>
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Nội dung điều khoản</h3>
                </div>
                <form role="form" enctype="multipart/form-data" method="POST" action="{{route('post.save')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{isset($news->id) ? $news->id : ''}}">
                    <div class="box-body">
                        <div class="form-group">
                            <textarea name="contents" id="contents" class="form-control" cols="30" rows="3" placeholder="Nội dung">{{old('content', isset($news->content) ? $news->content : '')}}</textarea>
                        </div>
                    </div>
                    <script>
                        ckeditor(contents);
                    </script>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection