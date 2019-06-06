@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Đề nghị xét tốt nghiệp
                    <small>Thêm mới</small>
                </h1>
            </div>
            <div class="col-lg-7" style="padding-bottom:120px">
                <div class=" errors alert alert-danger" style="display: none" ></div>

                <form id="totnghiepadd" method="POST">
                    <div class="form-group">
                        <label>Mã Sinh viên</label>
                        <input class="form-control" name="macn"  placeholder="Nhập Mã" />
                        <button class="btn btn-default" style="margin-top: 10px" id="timSinhVien">Tìm sinh viên</button>
                    </div>
                    <div class="form-group" id="sinhvieninfo">

                    </div>
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <a href="{{asset('/chuyennganh')}} " class="btn btn-default">Quay lại</a>
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
            $('#timSinhVien').click(function () {
                $.ajax({
                    url:'{{asset("api/totnghiep/sinhvien-view/")}}'+ '/'+2,
                    type:'GET',
                    // data:{id:$(this).attr('data-id')},
                    success:function (data) {
                        $('#sinhvieninfo').html(data);
                    }
                })
            })
            $(document).on('submit','#totnghiepadd',function (e) {
                e.preventDefault();
                $.ajax({
                    url:'{{asset("api/totnghiep/add")}}',
                    type:'POST',
                    data:new FormData(this),
                    cache:false,
                    contentType:false,
                    processData:false,
                    success:function (data) {
                        alert(data.success);
                        window.location.href='{{asset("/totnghiep")}}';
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

