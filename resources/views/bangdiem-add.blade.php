@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bảng điểm
                    <small>Thêm mới</small>
                </h1>
            </div>
            <div class="col-lg-7" style="padding-bottom:120px">
                <div class=" errors alert alert-danger" style="display: none" ></div>

                <form id="bangdiemadd" method="POST">
                    <div class="form-group">
                        <label>Chọn Sinh Viên</label>
                        <select name="id_sv"  class="form-control">
                            @foreach($sinhvien as $sv)
                            <option value="{{$sv->id}}" selected={{$sv->id == $bangdiem->id_sv}}>{{$sv->hoten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Chọn Môn học</label>
                        <select name="id_mh"  class="form-control">
                            @foreach($monhoc as $mh)
                            <option value="{{$mh->id}}">{{$mh->tenmon}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Điểm</label>
                        <input class="form-control" name="diemtk"  placeholder="Nhập điểm" />
                    </div>
                    <button type="submit" class="btn btn-success">Thêm mới</button>
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
            $(document).on('submit','#bangdiemadd',function (e) {
                e.preventDefault();
                $.ajax({
                    url:'{{asset("api/bangdiem/add")}}',
                    type:'POST',
                    data:new FormData(this),
                    cache:false,
                    contentType:false,
                    processData:false,
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

