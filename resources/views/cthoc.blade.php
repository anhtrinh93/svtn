@extends('master')
@section('content')
    <style>
        th, td { text-align: center; }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">QL chương trình học
                    <small>List</small>
                </h1>
            </div>
            <div class="row " style="margin-bottom: 10px;">
                <div class="col-md-10">
                </div>
                <div class="col-md-2">
                    <a href="{{asset('cthoc/add')}}" class="btn btn-success">Thêm mới</a>
                </div>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr align="center">
                    <th>Khóa</th>
                    <th>Tên Chuyên Ngành</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody id="data">
                    @foreach($cthoc as $value)
                        <tr>
                            <td>{{$value->khoa->tenkhoa}}</td>
                            <td>{{$value->chuyennganh->tencn}}</td>
                            <td><button class="btn btn-primary monhoc" data-id="{{$value->id}}" data-tk="{{$value->khoa->tenkhoa}}" data-cn="{{$value->chuyennganh->tencn}}">Môn Học</button>&nbsp;<a href="{{asset('cthoc/edit/'.$value->id)}}" class="btn btn-warning"><i class="fa fa-pencil fa-fw"></i></a> <button class="btn btn-danger delete"  data-id="{{$value->id}}"><i class="fa  fa-trash-o fa-fw"></i></button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <!-- Modal -->
    <div class="modal fade" id="monhocModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div id="monhoc">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.monhoc').click(function () {
                $('#monhocModal').modal('show');
                $('.modal-title').text($(this).attr('data-tk')+'-'+$(this).attr('data-cn')+' : Môn học');
                $.ajax({
                    url:'{{asset("api/cthoc/monhoc")}}',
                    type:'GET',
                    data:{id:$(this).attr('data-id')},
                    success:function (data) {
                        $('#monhoc').html(data);
                    }
                })
            })
            $(document).on('click','.delete',function () {
                if (confirm('Nếu bạn xóa thì các bảng có kết nối sẽ bị xóa? Bạn có muốn xóa ?')){
                    $.ajax({
                        url:  '{{asset("api/cthoc/delete")}}' +'/' +$(this).attr('data-id'),
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

