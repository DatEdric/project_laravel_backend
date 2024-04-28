<form role="form" method="post" action="">
    <div class="box-body">
        <div class="form-group {{ $errors->first('c_name') ? 'has-error' : '' }} ">
            <label for="inputEmail3" class="control-label default">Tên danh mục<sup class="title-sup">(*)</sup></label>
            <div>
                <input type="text" maxlength="100" class="form-control"  placeholder="Tên danh mục" name="c_name" value="{{ old('c_name', isset($category) ? $category->c_name : '') }}">
                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('c_name') }}</p></span>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i>Lưu</button>
        <a href="{{ route('get.list.category') }}" class="btn btn-danger"><i class="fa fa-close"></i> Bỏ qua</a>
    </div>
</form>