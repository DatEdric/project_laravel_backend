
<tr location="{{ $location }}" class="product_{{ $location }}">
    <td>
        <select name="d_book_id[{{ $location }}]" id="" class="form-control input_select2 pw_product_id pw_product_id_{{ $location }} col-md-3" required style="width: 100%">
            <option value="">--Chọn sách --</option>
            @if($books)
                @foreach($books as $key => $book)
                    <option value="{{ $book->id }}">{{ $book->b_name }}</option>
                @endforeach
            @endif
        </select>
    </td>

    <td>
        <input type="number" class="form-control pw_total_number" name="d_number[{{ $location }}]" total_number_location = "{{ $location }}" value="" placeholder="Number" min="1" required>
    </td>

    <td>
        <input type="date" class="form-control expiry_date" name="d_expiry_date[{{ $location }}]" value="">
    </td>
    <td>
        <input type="text" name="d_note[{{ $location }}]" class="form-control d_note" placeholder="Chú thích">
    </td>
    @if($action == 'update')
    <td>
        <select name="d_status[{{ $location }}]" id="" class="form-control">
            <option value="">--Chọn trạng thái--</option>
            <option value="1">Đã trả</option>
            <option value="2">Đã mất</option>
            <option value="3">Trả muộn</option>
        </select>
    </td>
    <td>
        <input type="number" name="d_forfeit[{{ $location }}]" class="form-control d_forfeit" placeholder="" value="">
    </td>
    @endif
    <td class="text-center"><a class="btn btn-xs btn-info delete-item-product mg-t-5"><i class="fa fa-trash-o"></i></a></td>
</tr>
<script>
    $(function () {
        $(".input_select2") .select2();
    })
</script>