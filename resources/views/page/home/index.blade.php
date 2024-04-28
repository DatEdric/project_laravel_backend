@extends('page.layouts.app')
@section('content')
    <div class="container" style="height: 69vh;">
        <div class="book-new">
            <h3 class="title-book text-center">Danh sách sách</h3>
            <div class="product">
                <div class="row">
                    <?php foreach ($books as $book) : ?>
                    <div class="col-md-3 mg-bt-15">
                        <div class="item-product">
                            <a href=""><img class="image-product" src="{{ !empty($book->b_image) ? asset('uploads/book/'.$book->b_image) : asset('page/images/no-image.jpg')  }}" alt=""></a>
                            <div class="info-product">
                                <a href="{{ route('user.detail.book', ['slug' => safeTitle($book->b_name), 'id' => $book->id]) }}" class="name-product">
                                    <div class="wrapper-content">
                                        <p>{{ $book->b_name }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="col-md-12 text-right">
                        <div class="box-footer text-center" style="float: right;">
                            {{ $books->appends($query = '')->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

