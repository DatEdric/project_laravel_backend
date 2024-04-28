@extends('page.layouts.app')
@section('content')
    <section class="content">
        <div class="detail-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <img style="width: 80%; height: 250px"  src="{{ !empty($book->b_image) ? asset('uploads/book/'.$book->b_image) : asset('page/images/no-image.jpg')  }}" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="clear"></div>
                        <div class="detail-info-book">
                            <div class="row">
                                <div class="col-md-12 info-book">
                                    <p>Mã sách : {{ $book->b_code_book }}</p>
                                    <p>Tên sách : {{ $book->b_name }}</p>
                                    <p>Danh mục : {{ $book->categories->c_name }}</p>
                                    <p>Nhà xuất bản : {{ $book->publishingCompany->pc_name }}</p>
                                    <p>Tác giả :
                                        @foreach($book->authorBook as $author)
                                            <span>{{ $author->at_name }}</span>
                                        @endforeach
                                    </p>
                                    <p>Năm xuất bản : {{ $book->b_publishing_year }}</p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="row">
                    <div class="book">
                        <h4>Giới thiệu sách</h4>
                        <div class="book-content">
                            {!! $book->b_description !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection