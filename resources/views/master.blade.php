<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{asset('')}}">
    <title></title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">
                {{--{{Auth::user()->role!='SV'? 'Quản lý xét tốt nghiệp':'Đăng ký tôt nghiệp'}}--}}
                asdasd
            </a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>asdasdasd <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="/"><i class="fa fa-dashboard fa-fw"></i> Tổng quan</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users fa-fw"></i>User<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/user">List </a>
                            </li>
                            <li>
                                <a href="/user/add">Add </a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users fa-fw"></i> Quản lý Sinh viên<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href={{url('/sinhvien')}}>Danh sách sinh viên </a>
                            </li>
                            <li>
                                <a href={{url('/bangdiem')}}>Danh sách bảng điểm </a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cube fa-fw"></i>Quản lý Chương trình học<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href={{url('/cthoc')}}>Chương trình học </a>
                            </li>
                            <li>
                                <a href={{url('/khoa')}}>Khoa </a>
                            </li>
                            <li>
                                <a href={{url('/khoahoc')}}>Khóa học </a>
                            </li>
                            <li>
                                <a href={{url('/chuyennganh')}}>Chuyên ngành </a>
                            </li>
                            <li>
                                <a href={{url('/monhoc')}}>Môn học </a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cube fa-fw"></i>Quản lý Dữ liệu Xét tốt nghiệp<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href={{url('/totnghiep?status=regist')}}>Danh sách đăng ký xét tốt nghiệp </a>
                            </li>
                            <li>
                                <a href={{url('/totnghiep?status=success')}}>Danh sách đã tốt nghiệp </a>
                            </li>
                            <li>
                                <a href={{url('/totnghiep?status=cancel')}}>Danh sách không đủ điều kiện tốt nghiệp </a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
<!--                    <li>-->
<!--                        <a href="/thongbao"><i class="fa fa-users fa-fw"></i>Thông báo<i class="fa fa-angle-right " style="float: right"></i> </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="/bangdiem"><i class="fa fa-users fa-fw"></i>Bảng điểm<i class="fa fa-angle-right " style="float: right"></i> </a>-->
<!--                    </li>-->
                    <li>
                        <a href="/logout"><i class="fa fa-power-off fa-fw"></i>Logout</a>
                    </li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        @yield('content')
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

<!-- DataTables JavaScript -->
<script src="bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
@yield('script')

</body>

</html>
