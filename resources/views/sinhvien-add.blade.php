@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sinh viên
                    <small>Thêm mới</small>
                </h1>
            </div>
            <div class="col-lg-7" style="padding-bottom:120px">
                <div class=" errors alert alert-danger" style="display: none" ></div>

                <form id="sinhvienadd" method="POST">
                    <div class="form-group">
                        <label>Mã Sinh viên</label>
                        <input class="form-control" name="masv"  placeholder="Nhập Mã" />

                    </div>
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input class="form-control" name="hoten"  placeholder="Nhập tên sinh viên" />

                    </div>
                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <input class="form-control" name="ngaysinh" type="date" />

                    </div>
                    <div class="form-group">
                        <label>Lớp học</label>
                        <input class="form-control" name="lophoc"  placeholder="Nhập lớp" />

                    </div>
                    <div class="form-group">
                        <label>Chọn khóa học</label>
                        <select name="khoa_id"  class="form-control">
                            @foreach($khoa as $k)
                                <option value="{{$k->id}}">{{$k->tenkhoa}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Chọn Chuyên Ngành</label>
                        <select name="cn_id"  class="form-control">
                            @foreach($chuyennganh as $cn)
                            <option value="{{$cn->id}}">{{$cn->tencn}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <a href="{{asset('/sinhvien')}} " class="btn btn-default">Quay lại</a>
                    {{csrf_field()}}
                    <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('submit','#sinhvienadd',function (e) {
                e.preventDefault();
                $.ajax({
                    url:'{{asset("api/sinhvien/add")}}',
                    type:'POST',
                    data:new FormData(this),
                    cache:false,
                    contentType:false,
                    processData:false,
                    success:function (data) {
                        alert(data.success);
                        window.location.href='{{asset("/sinhvien")}}';
                    },
                    statusCode: {
                        422: function(data) {
                            var errors=[]
                            $.each(data.responseJSON.errors.macn,function (index,value) {
                                errors.push(value);

                            })
                            $.each(data.responseJSON.errors.tencn,function (index,value) {
                                errors.push(value);

                            })
                            if (errors.length >0){
                                $('.errors').addClass('show')
                                var html='';
                                $.each(errors,function (index,value) {
                                    html+='<li>'+value;
                                    html+='</li>';
                                });
                                $('.errors').html(html);
                            }else{
                                $('.errors').addClass('hide')
                            }
                        }
                    }

                })
            })

        });
    </script>
@endsection

