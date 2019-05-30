@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Môn Học
                    <small>{{$monhoc->tenmon}}</small>
                </h1>
            </div>
            <div class="col-lg-7" style="padding-bottom:120px">
                <form id="monhocadd" method="POST">
                    <div class=" errors alert alert-danger" style="display: none" ></div>
                    <div class="form-group">
                        <label>Mã Môn học</label>
                        <input class="form-control" name="mamon" value="{{$monhoc->mamon}}"  placeholder="Nhập tên Mã môn" />
                    </div>
                    <div class="form-group">
                        <label>Tên Môn học</label>
                        <input class="form-control" name="tenmon" value="{{$monhoc->tenmon}}" placeholder="Nhập tên tên môn" />
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Số tín chỉ</label>
                            <input class="form-control" name="tinchi" value="{{$monhoc->tinchi}}" placeholder="Nhập số tín chỉ" />
                        </div>
                        <div class="col-md-6">
                            <label>Hệ số môn</label>
                            <input class="form-control" name="heso" value="{{$monhoc->heso}}" placeholder="Nhập hệ số môn" />
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success" id="update" data-id="{{$monhoc->id}}">Update</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <a href="{{asset('/monhoc')}} " class="btn btn-default">Quay lại</a>
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
            $(document).on('submit','#monhocadd',function (e) {
                e.preventDefault();
                $.ajax({
                    url:'{{asset("api/monhoc/update")}}/'+$('#update').attr('data-id'),
                    type: 'post',
                    data: new FormData(this),
                    cache:false,
                    processData:false,
                    contentType:false,
                    dataType: 'json',
                    headers: {"X-HTTP-Method-Override": "PUT"},
                    success:function (data) {
                        alert(data.success);
                        window.location.href='{{asset("/monhoc")}}';
                    },
                    statusCode: {
                        422: function(data) {
                            var errors=[]
                            $.each(data.responseJSON.errors.mamon,function (index,value) {
                                errors.push(value);

                            })
                            $.each(data.responseJSON.errors.tenmon,function (index,value) {
                                errors.push(value);

                            })
                            $.each(data.responseJSON.errors.tinchi,function (index,value) {
                                errors.push(value);

                            })
                            $.each(data.responseJSON.errors.heso,function (index,value) {
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

