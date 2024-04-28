<form role="form" method="post" action="">
    <div class="box-body">
        <div class="form-group {{ $errors->has('b_code_borrow') ? 'has-error' : '' }}">
            <div class="fs-13">
                <label for="company">Mã mượn <span class="title-sup">(*)</span></label>
            </div>
            <div class="col-sm-12" style="display: inline-block; padding: 0px;">
                <input class="form-control random_code" id="random_code" oninput="if(value.length>15)value=value.slice(0,15)" name="b_code_borrow" value="{{ old('b_code_borrow', isset($borrow) ? $borrow->b_code_borrow : '') }}" type="text" placeholder="Mã mượn" required>
            </div>
            @if($errors->has('b_code_borrow'))
                <span class="help-block">{{$errors->first('b_code_borrow')}}</span>
            @endif
            <div class="col-sm-12 default mg-t-10 mg-b-10" style="display: inline-block">
            <button class="btn btn-blue btn-info btn-change btn-change-code" ><i class="fa fa-fw fa-refresh"></i>Mã đã tạo</button>
            </div>
        </div>
        <div class="form-group {{ $errors->has('b_reader_id') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1" class="mg-t-10">Độc giả <sup class="title-sup">(*)</sup></label>
            <select name="b_reader_id" class="form-control input_select2" data-type="status" style="width: 100%">
                <option value="" >--Chọn độc giả --</option>
                @if (isset($readers))
                    @foreach($readers as $reader)
                        <option value="{{ $reader->id }}" {{ old('b_reader_id', isset($borrow->b_reader_id) ? $borrow->b_reader_id : '' ) == $reader->id ? "selected='selected'" : "" }}>{{ $reader->r_name }}</option>
                    @endforeach
                @endif
            </select>
            @if($errors->has('b_reader_id'))
                <span class="help-block">{{$errors->first('b_reader_id')}}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('b_note') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Ghi chú </label>
            <textarea name="b_note" class="form-control" id="" cols="30" rows="10">{{ old('b_note', isset($borrow) ? $borrow->b_note : '') }}</textarea>
            @if($errors->has('b_note'))
                <span class="help-block">{{$errors->first('b_note')}}</span>
            @endif
        </div>
    </div>
    <div class="box-body">
        <label for="exampleInputEmail1">Thêm mới sách <sup class="title-sup">(*)</sup></label>
        <table class="table table-bordered" id = "table-import-product" url="{!! route('add.row.book') !!}" actionTable ="{{ !isset($borrow) ? 'create' : 'update' }}">
            <thead>
            <tr>
                <th class="text-center" width="20%">Sách</th>
                <th class="text-center">Number</th>
                <th class="text-center">Ngày hết hạn</th>
                <th class="text-center">Chú thích</th>
                @if(isset($borrow))
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Tiền phạt</th>
                @endif
                <th width="2%" class="text-center">Xóa</th>
            </tr>
            </thead>
            <tbody class="content-table">
            @if (!isset($borrow))
                <tr location="0" class="product_0">
                    <td>
                        <select name="d_book_id[0]" id="" class="form-control input_select2 pw_product_id pw_product_id_0 col-md-3" required style="width: 100%">
                            <option value="">--Chọn sách --</option>
                            @if($books)
                                @foreach($books as $key => $book)
                                    <option value="{{ $book->id }}">{{ $book->b_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </td>

                    <td>
                        <input type="number" class="form-control pw_total_number" total_number_location="0" name="d_number[0]" value="" placeholder="Number" min="1" required>
                    </td>

                    <td>
                        <input type="date" class="form-control expiry_date" name="d_expiry_date[0]" value="" required>
                    </td>
                    <td>
                        <input type="text" name="d_note[0]" class="form-control d_note" placeholder="Chú thích">
                    </td>
                    <td class="text-center"><a class="btn btn-xs btn-info delete-item-product mg-t-5"><i class="fa fa-trash-o"></i></a></td>
                </tr>
            @else
                <?php $total = 0; ?>
                @foreach($borrow->orders as $keys => $order)
                <tr location="{{ $keys }}" class="product_{{ $keys }}">
                    <td>
                        <select name="d_book_id[{{ $keys }}]" id="" class="form-control input_select2 pw_product_id pw_product_id_{{ $keys }}" required>
                            <option value="">--Chọn sách--</option>
                            @if($books)
                                @foreach($books as $key => $book)
                                    <option {{ $book->id == $order->d_book_id ? 'selected=selected' : '' }} value="{{ $book->id }}" >{{ $book->b_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </td>

                    <td>
                        <input type="number" class="form-control pw_total_number" total_number_location = "{{ $keys }}" name="d_number[{{ $keys }}]" value="{{ $order->d_number }}" placeholder="Number" min="1" required>
                    </td>

                    <td>
                        <input type="date" class="form-control expiry_date" name="d_expiry_date[{{ $keys }}]" value="{{ $order->d_expiry_date }}">
                    </td>
                    <td>
                        <input type="text" name="d_note[{{ $keys }}]" class="form-control d_note" placeholder="Note" value="{{ $order->d_note }}">
                    </td>
                    <td>
                        <select name="d_status[{{ $keys }}]" id="" class="form-control">
                            <option value="">--Chọn trạng thái--</option>
                            <option value="2" {{ $order->d_status == 2 ? 'selected=selected' : '' }}>Đã trả</option>
                            <option value="3" {{ $order->d_status == 3 ? 'selected=selected' : '' }}>Đã mất</option>
                            <option value="4" {{ $order->d_status == 4 ? 'selected=selected' : '' }}>Trả muộn</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="d_forfeit[{{ $keys }}]" class="form-control d_forfeit" placeholder="" value="{{ $order->d_forfeit }}">
                    </td>
                    <td class="text-center"><a class="btn btn-xs btn-info delete-item-product mg-t-5"><i class="fa fa-trash-o"></i></a></td>
                </tr>
                @php
                    $total = $total + $order->d_forfeit;
                @endphp
                @endforeach

            @endif
            </tbody>
            @if (isset($borrow))
            <tr>
                <td colspan="5" class="text-center"> <b>Tổng tiền phạt</b> </td>
                <td colspan="2" class="text-center"> <b>{{ number_format($total, 0, ',', '.') }}vnđ</b> </td>
            </tr>
            @endif
        </table>
    </div>
    <div class="box-body text-right">
        <button type="button" class="btn btn-success mg-t-20 mg-b-15 btn-add-row-import_product"><i class="fa fa-plus-circle"></i> Thêm sách</button>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu</button>
        <a href="{{ route('get.list.borrow') }}" class="btn btn-danger"><i class="fa fa-close"></i> Bỏ qua</a>
    </div>
</form>