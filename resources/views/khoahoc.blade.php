@extends('master')
@section('content')
    <style>
        th.dt-center, td.dt-center { text-align: center; }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Khóa Học
                    <small>List</small>
                </h1>
            </div>
            <div class="row " style="margin-bottom: 10px;">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                    <a href="{{asset('khoahoc/add')}}" class="btn btn-success">Thêm mới</a>
                </div>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="khoatable">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Tên Khóa học</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody id="data">


                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            var table=$('#khoatable').DataTable({
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                responsive: true,
                ajax:{
                    url:'{{asset("api/khoahoc")}}',
                    type:'GET',
                    dataType:'json',
                },
                columns: [
                    { data: 'id' },
                    { data: 'tenkhoa' },
                    { data: 'action',"render":function (data,type,row) {
                            return '<a class="btn btn-primary" href="{{asset('/khoahoc')}}/'+row.id+'/ctrinhhoc">CT học</a>&ensp;<a class="btn btn-primary" href="{{asset('/khoahoc/edit')}}/'+row.id+'"><i class="fa fa-pencil fa-fw"></i></a>&ensp;<button class="btn btn-danger delete" data-id="'+row.id+'"><i class="fa fa-trash-o  fa-fw"></i></button>';
                        } }
                ]
            });
            $(document).on('click','.delete',function () {
                if (confirm('Nếu bạn xóa thì các bảng có kết nối sẽ bị xóa? Bạn có muốn xóa ?')){
                    $.ajax({
                        url:  '{{asset("api/khoahoc/delete")}}' +'/' +$(this).attr('data-id'),
                        type: 'post',
                        dataType: 'json',
                        headers: {"X-HTTP-Method-Override": "DELETE"},
                        success:function (data) {
                            alert(data.success);
                            table.ajax.reload();
                        },
                        // headers: {
                        //
                        //     "Content-Type": "application/json"
                        // },





                    })
                }
            })

        });
    </script>
@endsection

