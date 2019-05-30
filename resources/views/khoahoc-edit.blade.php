@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Khóa học
                    <small>{{$khoahoc->tenkhoa}}</small>
                </h1>
            </div>
            <div class="col-lg-7" style="padding-bottom:120px">
                <form  id="khoahocedit" >
                    <div class="form-group">
                        <label>Tên Khoa</label>
                        <input class="form-control" name="tenkhoa" id="tenkhoa" value="{{$khoahoc->tenkhoa}}"  placeholder="Nhập " />
                        <small id="errortenkhoa" style="color: red;"></small>
                    </div>
                    <button type="submit" class="btn btn-success" id="idkhoa" data-id="{{$khoahoc->id}}">Update</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <a href="{{asset('/khoahoc')}} " class="btn btn-default">Quay lại</a>
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
            $(document).on('submit','#khoahocedit',function (e) {
                e.preventDefault();

                var data=new FormData(this);
                // data={tenkhoa: $('#tenkhoa').val()}
                $.ajax({
                    url:  '{{asset("api/khoahoc/update")}}' +'/' +$('#idkhoa').attr('data-id'),
                    type: 'post',
                    data: new FormData(this),
                    cache:false,
                    processData:false,
                    contentType:false,
                    dataType: 'json',
                    headers: {"X-HTTP-Method-Override": "PUT"},
                    success:function (data) {
                        alert(data.success);
                        window.location.href='{{asset("/khoahoc")}}';
                    },
                    statusCode: {
                        422: function(data) {
                            $.each(data.responseJSON.errors.tenkhoa,function (index,value) {
                                $('#errortenkhoa').text(value);
                            });

                        }
                    }
                    // headers: {
                    //
                    //     "Content-Type": "application/json"
                    // },





                })
            })

        });
    </script>
@endsection

