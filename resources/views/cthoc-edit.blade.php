@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{$cthoc->khoa->tenkhoa}}-{{$cthoc->chuyennganh->tencn}}
                    <small>Edit CT Học</small>
                </h1>
            </div>
            <form action="" id="formsubmit">
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
               <table class="table table-bordered">
                   <th>STT</th>
                   <th>Môn học</th>
                   <th>Trạng thái</th>
                   @foreach($cthoc->monhoc as $key=> $mh)
                   <tr>
                       <td>{{$key+1}}</td>
                       <td>{{$mh->tenmon}}</td>
                       <input type="hidden" name="mh_id[]" value="{{$mh->id}}">
                       <td><input type="text" name="status[]" value="{{$mh->pivot->status}}"></td>
                   </tr>
                   @endforeach

               </table>
                <div class="row">

                    <div class="row"><label for="" style="margin-left: 40px">Thêm Môn học</label></div>
                    @foreach($monhoc as $mh)
                    <div class="col-md-4">
                        <input type="checkbox"  class="mh_id" value="{{$mh->id}}">{{$mh->tenmon}}
                        <input type="text" class="form-inline " id="status-{{$mh->id}}" value=""style="float: right;width: 20%;margin-bottom: 10px;">
                    </div>

                    @endforeach

                </div>
                <button class="btn btn-primary" id="update" data-id="{{$cthoc->id}}">Update</button>
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
            $('#formsubmit').submit(function (e) {
                e.preventDefault();
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
                    url:'{{asset("api/cthoc/update")}}/'+$('#update').attr('data-id'),
                    type: 'post',
                    data: new FormData(this),
                    cache:false,
                    processData:false,
                    contentType:false,
                    dataType: 'json',
                    headers: {"X-HTTP-Method-Override": "PUT"},
                    success:function (data) {
                        alert(data.success);
                        window.location.href='{{asset("cthoc")}}';
                    },
                })

            })


        });
    </script>
@endsection

