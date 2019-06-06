@extends('master')
@section('content')
<style>
    th.dt-center, td.dt-center { text-align: center; }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <div class="row " style="margin-bottom: 10px;">
                    <div class="col-md-10">Bảng Điểm <small>List</small></div>
                    <div class="col-md-2">
<!--                        <a href="{{asset('bangdiem/add')}}" class="btn btn-success">Thêm mới</a>-->
                    </div>
                </div>
            </h1>
        </div>
        <div class="row " style="margin-bottom: 10px;">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="{{asset('bangdiem/import')}}" method="POST" id="importsv" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="file" name="file" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Import</button>
                        </div>


                    </div>

                    {{csrf_field()}}
                </form>
            </div>

        </div>
        <!-- /.col-lg-12 -->
        <table class="table table-striped table-bordered table-hover" id="bangdiemtable">
            <thead>
            <tr align="center">
                <th>ID</th>
                <th>Sinh Viên</th>
                <th>Môn Học</th>
                <th>Điểm Tổng kết</th>
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
        var table=$('#bangdiemtable').DataTable({
            "columnDefs": [
                {"className": "dt-center", "targets": "_all"}
            ],
            responsive: true,
            ajax:{
                url:'{{asset("api/bangdiem")}}',
                type:'GET',
                dataType:'json',
            },
            columns: [
                { data: 'id' },
                { data: 'hoten' },
                { data: 'tenmon' },
                { data: 'diemtk' },
                { data: 'action',"render":function (data,type,row) {
                        return '<button class="btn btn-danger delete" data-id="'+row.id+'"><i class="fa fa-trash-o  fa-fw"></i></button>';
                    } }
            ]
        });
        $(document).on('click','.delete',function () {
            if (confirm('Nếu bạn xóa thì các bảng có kết nối sẽ bị xóa? Bạn có muốn xóa ?')){
                $.ajax({
                    url:  '{{asset("api/khoa/delete")}}' +'/' +$(this).attr('data-id'),
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

