<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title','Quản lý thư viện')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/Ionicons/css/ionicons.min.css') }}">
    {{--jquery-confirm--}}
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/jquery-confirm/dist/jquery-confirm.min.css') }}">
    {{--select2--}}
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/select2/dist/css/select2.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/theme/dist/css/AdminLTE.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('admin/theme/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <!-- Google Font -->
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">--}}
    @yield('style')
    <style>
        .main_content { margin-top: 20px}
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">L<b></b>M</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Quản lý thư viện</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">{{ Auth::user()->name ?? Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <p>
                                    <small>Email : {{ Auth::user()->email ?? Auth::user()->email }}</small>
                                    <small>Phone : {{ Auth::user()->phone ?? Auth::user()->phone }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{route('get.account.info')}}" class="btn btn-default btn-flat">Thông tin tài khoản</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{route('logout')}}" class="btn btn-default btn-flat">Đăng xuất</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- =============================================== -->
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu navigation" data-widget="tree">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-home"></i> <span>Trang chủ </span>
                    </a>
                </li>
                @if (Auth::user()->can(['danh-sach-khoi-lop', 'danh-sach-lop', 'danh-sach-nguoi-doc', 'toan-quyen-quan-ly']))
                <li class="treeview @if($activeMenu == 'Class' || $activeMenu == 'Department' || $activeMenu == 'Reader') active menu-open @endif">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span>Quản lý độc giả</span>
                    </a>
                    <ul class="treeview-menu @if($activeMenu == 'Class' || $activeMenu == 'Department' || $activeMenu == 'Reader') active menu-open @endif">
                        @if (Auth::user()->can(['danh-sach-khoi-lop', 'toan-quyen-quan-ly']))
                        <li class="{{ $activeMenu == 'Department' ? 'active menu-open' : '' }}"><a href="{{ route('get.list.department') }}"><i class="fa fa-circle-o"></i> <span>Khối lớp</span></a></li>
                        @endif
                        @if (Auth::user()->can(['danh-sach-lop', 'toan-quyen-quan-ly']))
                        <li class="{{ $activeMenu == 'Class' ? 'active menu-open' : '' }}"><a href="{{ route('get.list.class') }}"><i class="fa fa-circle-o"></i> <span>Lớp</span></a></li>
                        @endif
                        @if (Auth::user()->can(['danh-sach-nguoi-doc', 'toan-quyen-quan-ly']))
                        <li class="{{ $activeMenu == 'Reader' ? 'active menu-open' : '' }}"><a href="{{ route('get.list.reader') }}"><i class="fa fa-circle-o"></i> <span>Độc giả</span></a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (Auth::user()->can(['danh-sach-tac-gia', 'danh-sach-danh-muc', 'danh-sach-nha-xuat-ban', 'danh-sach-sach', 'toan-quyen-quan-ly']))
                <li class="treeview @if($activeMenu == 'Author' || $activeMenu == 'Category' || $activeMenu == 'Publishing_Company' || $activeMenu == 'Book' || $activeMenu == 'ImportBook') active menu-open @endif">
                    <a href="#">
                        <i class="fa fa-fw fa-book"></i>
                        <span>Quản lý sách</span>
                    </a>
                    <ul class="treeview-menu @if($activeMenu == 'Author' || $activeMenu == 'Category' || $activeMenu == 'Publishing_Company' || $activeMenu == 'Book') active menu-open @endif">
                        @if (Auth::user()->can(['danh-sach-tac-gia', 'toan-quyen-quan-ly']))
                        <li class="{{ $activeMenu == 'Author' ? 'active menu-open' : '' }}"><a href="{{ route('get.list.author') }}"><i class="fa fa-circle-o"></i> <span>Tác giả</span></a></li>
                        @endif
                        @if (Auth::user()->can(['danh-sach-danh-muc', 'toan-quyen-quan-ly']))
                        <li class="{{ $activeMenu == 'Category' ? 'active menu-open' : '' }}"><a href="{{ route('get.list.category') }}"><i class="fa fa-circle-o"></i> <span>Danh mục</span></a></li>
                        @endif
                        @if (Auth::user()->can(['danh-sach-nha-xuat-ban', 'toan-quyen-quan-ly']))
                        <li class="{{ $activeMenu == 'Publishing_Company' ? 'active menu-open' : '' }}"><a href="{{ route('get.list.publishing_company') }}"><i class="fa fa-circle-o"></i> <span>Nhà xuất bản</span></a></li>
                        @endif
                        @if (Auth::user()->can(['danh-sach-sach', 'toan-quyen-quan-ly']))
                        <li class="{{ $activeMenu == 'Book' || $activeMenu == 'ImportBook' ? 'active menu-open' : '' }}"><a href="{{ route('get.list.book') }}"><i class="fa fa-circle-o"></i> <span>Sách</span></a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (Auth::user()->can(['danh-sach-muon-sach', 'danh-sach-thong-tin-muon-sach', 'toan-quyen-quan-ly']))
                <li class="treeview @if($activeMenu == 'Borrow' || $activeMenu == 'ListBorrowBook') active menu-open @endif">
                    <a href="#">
                        <i class="fa fa-fw fa-book"></i>
                        <span>Quản lý mượn sách</span>
                    </a>
                    <ul class="treeview-menu @if($activeMenu == 'Borrow' || $activeMenu == 'ListBorrowBook') active menu-open @endif">
                        @if (Auth::user()->can(['danh-sach-muon-sach', 'toan-quyen-quan-ly']))
                        <li class="{{ $activeMenu == 'Borrow' ? 'active menu-open' : '' }}"><a href="{{ route('get.list.borrow') }}"><i class="fa fa-circle-o"></i> <span>Danh sách mượn </span></a></li>
                        @endif
                        @if (Auth::user()->can(['danh-sach-thong-tin-muon-sach', 'toan-quyen-quan-ly']))
                        <li class="{{ $activeMenu == 'ListBorrowBook' ? 'active menu-open' : '' }}"><a href="{{ route('get.list.borrow.book') }}"><i class="fa fa-circle-o"></i> <span>Thông tin mượn sách </span></a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (Auth::user()->can(['danh-sach-nguoi-dung', 'danh-sach-vai-tro', 'toan-quyen-quan-ly']))
                <li class="treeview @if($activeMenu == 'GroupPermission' || $activeMenu == 'Permission' || $activeMenu == 'Role' || $activeMenu == 'User') active menu-open @endif">
                    <a href="#">
                        <i class="fa fa-fw fa-unlock-alt"></i>
                        <span>Quản lý hệ thống</span>
                    </a>
                    <ul class="treeview-menu @if($activeMenu == 'GroupPermission' || $activeMenu == 'Permission' || $activeMenu == 'Role' || $activeMenu == 'User') active menu-open @endif">
                        @if (Auth::user()->can(['danh-sach-nguoi-dung', 'toan-quyen-quan-ly']))
                        <li class="{{ $activeMenu == 'User' ? 'active menu-open' : '' }}"><a href="{{ route('get.list.user') }}"><i class="fa fa-circle-o"></i> <span>Người dùng</span></a></li>
                        @endif
                        @if (Auth::user()->can(['danh-sach-vai-tro', 'toan-quyen-quan-ly']))
                        <li class="{{ $activeMenu == 'Role' ? 'active menu-open' : '' }}"><a href="{{ route('get.list.role') }}"><i class="fa fa-circle-o"></i> <span>Vai trò</span></a></li>
                        @endif
                        {{--<li class="{{ $activeMenu == 'GroupPermission' ? 'active menu-open' : '' }}"><a href="{{ route('get.list.group-permission') }}"><i class="fa fa-circle-o"></i> <span>Group Permission</span></a></li>--}}
                        {{--<li class="{{ $activeMenu == 'Permission' ? 'active menu-open' : '' }}"><a href="{{ route('get.list.permission') }}"><i class="fa fa-circle-o"></i> <span>Permission</span></a></li>--}}
                    </ul>
                </li>
                @endif
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="height: 1200px;">
    @include('components.alert')
    @yield('content')

    <!-- Content Header (Page header) -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2023-2024 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>
    <!-- Control Sidebar -->
    <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="{{ asset('admin/theme/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/theme/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('admin/theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/theme/bower_components/fastclick/lib/fastclick.js') }}"></script>
{{--jquery-confirm--}}
<script src="{{ asset('admin/theme/bower_components/jquery-confirm/dist/jquery-confirm.min.js') }}"></script>
{{--select2--}}
<script src="{{ asset('admin/theme/bower_components/select2/dist/js/select2.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/theme/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/theme/dist/js/demo.js') }}"></script>
{{--Main--}}
<script src="{{ asset('admin/js/main.js') }}"></script>
<script>
    var check_book = "{{ route('admin.check.book') }}"
    $(document).ready(function () {

        var url = window.location;
        var element = $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().parent().parent().addClass('active').addClass('menu-open');

        var e = $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active').addClass('menu-open');

        // setTimeout(function(){
        //     $('.show-notification').slideUp(2000);
        // }, 3000);

        $('.sidebar-menu').tree()
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('[data-toggle="tooltip"]').tooltip();
        $(".input_select2") .select2();
    })

</script>
@yield('script')
</body>
</html>

