<header>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="log">
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('user.home') }}" method="GET" class="form-search">
                        <div class="form-group has-search">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text" name="b_name" class="form-control input-seach" placeholder="Tìm kiếm tựa sách, tên tác giả, danh mục">
                            <button class="btn btn-search" type="submit">
                                Tìm kiếm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav" style="margin: auto !important;">
                <li class="nav-item active">
                    <a href="{{ route('user.home') }}">Trang chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a href="#"></a>
                </li>

            </ul>
        </div>
    </nav>
</header>