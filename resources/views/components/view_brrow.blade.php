<div class="col-md-8 default">
    <p><b>Mã mượn : {{ $borrow->b_code_borrow }}</b></p>
    <p><b>Tên người đọc : {{ $borrow->reader !== null ? $borrow->reader->r_name : '' }}</b></p>
    @if (!empty( $borrow->b_note ))
        <p><b>Ghi chú : {{ $borrow->w_note  }}</b></p>
    @endif
    <p><b>Ngày tạo : {{ $borrow->created_at  }}</b></p>
</div>

<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th style="width: 2%;" class="text-center">STT</th>
        <th>Tên sách</th>
        <th>Number</th>
        <th>Ngày hết hạn</th>
        <th>Chú thích</th>
        <th>Trạng thái</th>
        <th>Tiền phạt</th>
    </tr>
    </thead>
    <tbody>
    <?php $total = 0; ?>
    @foreach($borrow->orders as $key => $orders)

        <tr @if(getDay($orders->d_expiry_date) < 0 && $orders->d_status == 1)) style="background-color: #c6c6c6;" title="Payment is overdue" @endif>
            <td style="width: 2%;">{{ $key + 1 }}</td>
            <td>
                <p class="text-space-account">
                    <span class="content-space" data-toggle="tooltip" title="{{ $orders->book !== null ? $orders->book->b_name : '' }}">
                       {{ $orders->book !== null ? $orders->book->b_name : '' }}
                    </span>
                </p>
            </td>
            <td>{{ $orders->d_number }}</td>
            <td>{{ $orders->d_expiry_date }}</td>
            <td>
                <p class="text-space-account">
                    <span class="content-space" data-toggle="tooltip" title="{{ $orders->d_note }}">
                       {{ $orders->d_note }}
                    </span>
                </p>
            </td>
            <td>{{ STATUS_BORROW[$orders->d_status] }}</td>
            <td>{{ number_format($orders->d_forfeit, 0, ',', '.') }}$</td>
        </tr>
        @php
            $total = $total + $orders->d_forfeit;
        @endphp
    @endforeach
    <tr>
        <td colspan="6" class="text-center"> <b>Tổng tiền phạt</b> </td>
        <td colspan="2"> <b>{{ number_format($total, 0, ',', '.') }}$</b> </td>
    </tr>
    </tbody>
</table>