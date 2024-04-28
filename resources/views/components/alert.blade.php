@php
    $array_alert = [
        'danger',
        'info',
        'warning',
        'success'
    ];

@endphp
@foreach($array_alert as $item)
    @if (session($item))
        <section class="content-header show-notification">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="callout callout-{{ $item }}">
                                <p>{{ session($item) }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </section>
    @endif
@endforeach