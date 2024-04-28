<form role="form" method="post" action="" enctype="multipart/form-data">
    <div class="box-body">
        <div class="col-md-6 default">
            <div class="form-group {{ $errors->first('r_name') ? 'has-error' : '' }} ">
                <label for="inputEmail3" class="control-label default">Tên độc giả<sup class="title-sup">(*)</sup></label>
                <div>
                    <input type="text" maxlength="100" class="form-control"  placeholder="Tên độc giả" name="r_name" value="{{ old('r_name', isset($reader) ? $reader->r_name : '') }}">
                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('r_name') }}</p></span>
                </div>
            </div>

            <div class="form-group {{ $errors->first('r_gender') ? 'has-error' : '' }}">
                <label for="inputEmail3" class="control-label default">Giới tính<sup class="title-sup">(*)</sup></label>
                <select name="r_gender" class=" form-control" data-type="r_gender" style="width: 100%">
                    <option value="" >--Chọn giới tính--</option>
                    <option value="1" {{ old('r_gender', isset($reader->r_gender) ? $reader->r_gender : '') == 1 ? "selected='selected'" : "" }}>Nam</option>
                    <option value="2" {{ old('r_gender', isset($reader->r_gender) ? $reader->r_gender : '') == 2 ? "selected='selected'" : "" }}>Nữ</option>
                </select>
                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('r_gender') }}</p></span>
            </div>

            <div class="form-group {{ $errors->first('r_birthday') ? 'has-error' : '' }} ">
                <label for="inputEmail3" class="control-label default">Ngày sinh<sup class="title-sup">(*)</sup></label>
                <div>
                    <input type="date" class="form-control" name="r_birthday" placeholder="Birthday" value="{{ old('r_birthday', isset($reader->r_birthday) ? $reader->r_birthday : '') }}" style="width: 100%">
                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('r_birthday') }}</p></span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="control-label default">Khối lớp </label>
                <select name="r_department_id" class="form-control input_select2" data-type="status" style="width: 100%">
                    <option value="" >--Chọn khối lớp--</option>
                    @if (isset($departments))
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ old('r_department_id', isset($reader->r_department_id) ? $reader->r_department_id : '' ) == $department->id ? "selected='selected'" : "" }}>{{ $department->d_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="control-label default">Lớp </label>
                <select name="r_class_id"  class="form-control input_select2" data-type="status" style="width: 100%">
                    <option value="" >--Chọn lớp--</option>
                    @if (isset($class))
                        @foreach($class as $value)
                            <option value="{{ $value->id }}" {{ old('r_class_id', isset($reader->r_class_id) ? $reader->r_class_id : '') == $value->id ? "selected='selected'" : "" }}>{{ $value->c_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group {{ $errors->first('r_address') ? 'has-error' : '' }} ">
                <label for="inputEmail3" class="control-label default">Địa chỉ</label>
                <div>
                    <input type="text" maxlength="100" class="form-control"  placeholder="Địa chỉ" name="r_address" value="{{ old('r_address', isset($reader) ? $reader->r_address : '') }}">
                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('r_address') }}</p></span>
                </div>
            </div>
            <div class="form-group {{ $errors->first('r_phone') ? 'has-error' : '' }} ">
                <label for="inputEmail3" class="control-label default">Số điện thoại </label>
                <div>
                    <input type="text" maxlength="100" class="form-control"  placeholder="Số điện thoại" name="r_phone" value="{{ old('r_phone', isset($reader) ? $reader->r_phone : '') }}">
                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('r_phone') }}</p></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="control-label default">Trạng thái độc giả</label>
                <select name="r_status" class=" form-control" data-type="r_status" style="width: 100%">
                    <option value="1" {{ old('r_status', isset($reader->r_status) ? $reader->r_status : '') == 1 ? "selected='selected'" : "" }}>Hoạt động</option>
                    <option value="2" {{ old('r_status', isset($reader->r_status) ? $reader->r_status : '') == 2 ? "selected='selected'" : "" }}>Tạm ngưng</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-12 default">
                <label for="inputEmail3">Ảnh </label>
                <div class="input-group input-file" name="images">
                        <span class="input-group-btn">
                            <button class="btn btn-default btn-choose" type="button">Chọn</button>
                        </span>
                    <input type="text" class="form-control"   placeholder='Chọn ảnh..' style="width: 250px;" />
                    <span class="input-group-btn"></span>
                </div>
                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('images') }}</p></span>
                <img src="@if(isset($reader)) {!! asset('uploads/avatar/'. $reader->r_avatar) !!} @else {{ asset('admin/images/no-image.png')  }} @endif" alt="" class="margin-auto-div img-rounded"  id="image_render" style="width: 320px; float: left; height: 195px;">
            </div>

            <div class="form-group col-md-12 default {{ $errors->has('r_code_card') ? 'has-error' : '' }}" style="margin-top: 13px">
                <label for="inputEmail3" class="control-label default col-sm-12">Mã thẻ</label>
                <div class="col-sm-8" style="display: inline-block; padding: 0px;">
                    <input class="form-control random_code" id="random_code" style="width: 320px;" oninput="if(value.length>10)value=value.slice(0,10)" name="r_code_card" value="{{ old('r_code_card', isset($reader) ? $reader->r_code_card : '') }}" type="text" placeholder="Code Card">
                </div>
                <div class="col-sm-4 default" style="display: inline-block;">
                    <button class="btn btn-blue btn-info btn-change btn-change-code" ><i class="fa fa-fw fa-refresh"></i> Tạo mã</button>
                </div>
                <div class="col-sm-12 default" style="display: inline-block;">
                    @if($errors->has('r_code_card'))
                        <span class="help-block">{{$errors->first('r_code_card')}}</span>
                    @endif
                </div>
            </div>

            <div class="form-group col-md-12 default {{ $errors->has('r_card_created_date') ? 'has-error' : '' }}" style="margin-top: 13px">
                <label for="inputEmail3" class="control-label default">Ngày tạo thẻ</label>
                <div>
                    <input type="date" class="form-control input_created_date" name="r_card_created_date" placeholder="Ngày tạo thẻ" value="{{ old('r_card_created_date', isset($reader->r_card_created_date) ? $reader->r_card_created_date : '') }}" style="width: 100%">
                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('r_card_created_date') }}</p></span>
                </div>
            </div>

            <div class="form-group col-md-12 default  {{ $errors->has('r_card_expiry_date') ? 'has-error' : '' }}" style="margin-top: 6px">
                <label for="inputEmail3" class="control-label default">Ngày hết hạn thẻ</label>
                <div>
                    <input type="date" class="form-control input_expiry_date" name="r_card_expiry_date" placeholder="Ngày hết hạn thẻ" value="{{ old('r_card_expiry_date', isset($reader->r_card_expiry_date) ? $reader->r_card_expiry_date : '') }}" style="width: 100%">
                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('r_card_expiry_date') }}</p></span>
                </div>
            </div>

            <div class="form-group col-md-12 default mg-t-5">
                <label for="inputEmail3" class="control-label default">Trạng thái thẻ</label>
                <select name="r_card_status" class=" form-control" data-type="r_card_status" style="width: 100%">
                    <option value="2" {{ old('r_card_status', isset($reader->r_card_status) ? $reader->r_card_status : '') == 2 ? "selected='selected'" : "" }}>Hoạt động</option>
                    <option value="1" {{ old('r_card_status', isset($reader->r_card_status) ? $reader->r_card_status : '') == 1 ? "selected='selected'" : "" }}>Đã khóa</option>
                </select>
            </div>
        </div>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary" id="btn_save_data"><i class="fa fa-floppy-o"></i> Lưu</button>
        <a href="{{ route('get.list.reader') }}" class="btn btn-danger"><i class="fa fa-close"></i> Bỏ qua</a>
    </div>
</form>

