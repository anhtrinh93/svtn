@extends('master')
@section('content')
<div class="container-fluid">
    <style>
        th.dt-center, td.dt-center { text-align: center; }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <div class="row " style="margin-bottom: 10px;">
                    <div class="col-md-10">Danh sách Sinh Viên
                        <small>List</small>
                    </div>
                    <div class="col-md-2">
                        <a href="{{asset('totnghiep/add')}}" class="btn btn-success">Thêm mới</a>
                    </div>
                </div>
            </h1>
        </div>
        @if(count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            {{$error}}
            @endforeach
        </div>
        @endif
<!--         /.col-lg-12 -->
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
            <tr align="center">
                <th>MaSV</th>
                <th>Họ Tên</th>
                <th>Khóa Học</th>
                <th>Chuyên Ngành</th>
                <th>Lớp Học</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sinhvien as $sv)
            <tr class="odd gradeX" align="center">
                <td>{{$sv->masv}}</td>
                <td>{{$sv->hoten}}</td>
                <td>{{$sv->khoahoc->tenkhoa}}</td>
                <td>{{$sv->chuyennganh->tencn}}</td>
                <td>{{$sv->lophoc}}</td>
                <td>
                    @if ($sv->totnghiep_status === 0)
                        Đang học tập
                    @elseif ($sv->totnghiep_status === 1)
                        Đề nghị xét tốt nghiệp
                    @elseif ($sv->totnghiep_status === 2)
                        Đã tốt nghiệp
                    @elseif ($sv->totnghiep_status === 3)
                        Không đủ điều kiện tốt nghiệp
                    @else
                        Khác
                    @endif
                </td>
                <td>
                    <a class="btn btn-success view"  data-id="{{$sv->id}}">View</a>
                    <button class="btn btn-danger delete" data-id="{{$sv->id}}"><i class="fa fa-trash"></i></button></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<!-- Modal -->
<div class="modal fade" id="totnghiepModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="content">

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
    $(document).ready(function () {
        $('.bangdiem').click(function () {
            $('#totnghiepModal').modal('show');
            $.ajax({
                url:'{{asset("api/sinhvien/getdiem")}}',
                type:'GET',
                data:{id:$(this).attr('data-id')},
                success:function (data) {
                    $('#content').html(data);
                }
            })
        })
        $('.view').click(function () {
            $('#totnghiepModal').modal('show');
            $.ajax({
                url:'{{asset("api/totnghiep/sinhvien-view/")}}'+ '/'+$(this).attr('data-id'),
                type:'GET',
                // data:{id:$(this).attr('data-id')},
                success:function (data) {
                    $('#content').html(data);
                }
            })
        })
        $('.delete').click(function () {
            if (confirm('Bạn muốn xóa?')){
                $.ajax({
                    url:  '{{asset("api/sinhvien/delete")}}' +'/' +$(this).attr('data-id'),
                    type: 'post',
                    dataType: 'json',
                    headers: {"X-HTTP-Method-Override": "DELETE"},
                    success:function (data) {
                        alert(data.success);
                        window.location.reload();
                    }
                })
            }
        })
    })
</script>
@stop