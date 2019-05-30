@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Quản lý chương trình học
                    <small>Thêm mới</small>
                </h1>
            </div>

            <form id="form-submit" action="">
                <div class="form-group">
                    <label for="">Khóa học</label>
                    <select name="kh_id" class="form-control" id="kh_id">
                        @foreach($khoahoc as $kh)
                            <option value="{{$kh->id}}">{{$kh->tenkhoa}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Chuyên ngành</label>
                    <select name="cn_id" class="form-control" id="cn_id">
                        @foreach($chuyennganh as $cn)
                            <option value="{{$cn->id}}">{{$cn->tencn}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">

                        <div class="row"><label for="" style="margin-left: 40px">Môn học</label></div>
                        @foreach($monhoc as $mh)
                            <div class="col-md-4">
                                <input type="checkbox"  class="mh_id" value="{{$mh->id}}">{{$mh->tenmon}}
                                <input type="text" class="form-inline " id="status-{{$mh->id}}" value=""    style="float: right;width: 20%;margin-bottom: 10px;">
                            </div>

                        @endforeach

                </div>

                <div class="row">
                    <div class="col-sm-offset-6">
                        <button type="submit" class="btn btn-primary" style="margin: 20px 0px">Thêm mới</button>
                    </div>
                </div>
                {{csrf_field()}}


            </form>


        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#form-submit').submit(function (e) {
                var a=[];
                var b=[];
                var formData=new FormData(this);
              e.preventDefault();

                $(".mh_id:checked").each(function(){

                    a.push($(this).val());
                    b.push($('#status-'+$(this).val()).val());
                })
                formData.append('mh_id',a);
                formData.append('status',b);
              $.ajax({
                  url:'{{asset("api/cthoc/add")}}',
                  type:'POST',
                  data:formData,
                  cache:false,
                  contentType:false,
                  processData:false,
                  success:function (data) {
                      alert(data.success)
                  }
              })
            })

        });
    </script>
@endsection

