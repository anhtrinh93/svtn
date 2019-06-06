@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bảng điểm
                    <small>{{$bangdiem->hoten}}</small>
                </h1>
            </div>
            <div class="col-lg-7" style="padding-bottom:120px">
                <div class=" errors alert alert-danger" style="display: none" ></div>

                <form id="bangdiemedit" method="POST">
                    <div class="form-group">
                        <label>Chọn Sinh Viên</label>
                        <select name="id_sv"  class="form-control">
                            @foreach($sinhvien as $sv)
                            <option value="{{$sv->id}}" selected={{$sv->id == $bangdiem->id_sv}}>{{$sv->id == $bangdiem->id_sv}}{{$sv->hoten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Chọn Môn học</label>
                        <select name="id_mh"  class="form-control">
                            @foreach($monhoc as $mh)
                            <option value="{{$mh->id}}" selected={{$mh->id == $bangdiem->id_mh}}>{{$mh->tenmon}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Điểm</label>
                        <input class="form-control" name="diemtk"  placeholder="Nhập điểm" value={{$bangdiem->diemtk}}/>
                    </div>
                    <button type="submit" class="btn btn-success" id="update" data-id="{{$bangdiem->id}}">Lưu thông tin</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <a href="{{asset('/bangdiem')}} " class="btn btn-default">Quay lại</a>
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
            $(document).on('submit','#bangdiemedit',function (e) {
                e.preventDefault();
                $.ajax({
                    url:'{{asset("api/bangdiem/update")}}/'+$('#update').attr('data-id'),
                    type: 'post',
                    data: new FormData(this),
                    cache:false,
                    processData:false,
                    contentType:false,
                    dataType: 'json',
                    headers: {"X-HTTP-Method-Override": "PUT"},
                    success:function (data) {
                        alert(data.success);
                        window.location.href='{{asset("/bangdiem")}}';
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
                                $('.errors').text($.each(errors,function (index,value) {
                                    return value;

                                }))
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

