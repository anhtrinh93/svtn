@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{$kh_cn->khoa->tenkhoa}}-{{$kh_cn->chuyennganh->tencn}}
                    <small>Edit CT Học</small>
                </h1>
            </div>
            <form action="" id="formsubmit">
               <table class="table table-bordered">
                   <th>STT</th>
                   <th>Môn học</th>
                   <th>Trạng thái</th>
                   @foreach($kh_cn->monhoc as $key=> $mh)
                   <tr>
                       <td>{{$key+1}}</td>
                       <td>{{$mh->tenmon}}</td>
                       <input type="hidden" name="mh_id[]" value="{{$mh->id}}">
                       <td><input type="text" name="status[]" value="{{$mh->pivot->status}}"></td>
                   </tr>
                   @endforeach
               </table>
                <button class="btn btn-primary" id="update" data-id="{{$kh_cn->id}}">Update</button>
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
                var formData=new FormData(this);
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

