<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sinh viên
                <small>{{$sinhvien->hoten}}</small>
            </h1>
        </div>
        <div class="col-lg-7" style="padding-bottom:20px">
            <div class=" errors alert alert-danger" style="display: none" ></div>
            <div class="form-group">
                <label>Mã Sinh viên</label>
                <h4>{{$sinhvien->masv}}</h4>

            </div>
            <div class="form-group">
                <label>Họ tên</label>
                <h4>{{$sinhvien->hoten}}</h4>

            </div>
            <div class="form-group">
                <label>Ngày sinh</label>
                <h4>{{$sinhvien->ngaysinh}}</h4>

            </div>
            <div class="form-group">
                <label>Lớp học</label>
                <h4>{{$sinhvien->lophoc}}</h4>

            </div>
            <div class="form-group">
                <label>Khóa</label> <br/>
                @foreach($khoa as $k)
                {{$k->id == $sinhvien->kh_id ? $k->tenkhoa : ""}}
                @endforeach
            </div>
            <div class="form-group">
                <label>Chuyên Ngành</label>
                @foreach($chuyennganh as $cn)
                {{$cn->id == $sinhvien->cn_id ? $cn->tencn : ""}}
                @endforeach
            </div>
        </div>
        <div class="col-lg-12">
            <h3 class="" style="text-align:center; font-weight: bold">BẢNG ĐIỂM SINH VIÊN</h3>
            <div id="bangdiem" data-id="{{$sinhvien->id}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-success update-graduated" data-id="{{$sinhvien->id}}">Duyệt tốt nghiệp</button>
            <button class="btn btn-danger update-non-graduated" data-id="{{$sinhvien->id}}">Không đủ điều kiện tốt nghiệp</button>
        </div>
    </div>
    <!-- /.row -->
</div>
<script>
    $(document).ready(function(){
        $.ajax({
            url:'{{asset("api/sinhvien/getdiem")}}',
            type:'GET',
            data:{id:$('#bangdiem').attr('data-id')},
            success:function (data) {
                $('#bangdiem').html(data);
            }
        })

        $('.update-graduated').click(function () {
            if (confirm('Bạn muốn thực hiện hành động này?')){
                $.ajax({
                    url:  '{{asset("api/sinhvien/update_status")}}' +'/' +$(this).attr('data-id')+ '?totnghiep_status=2',
                    type: 'post',
                    dataType: 'json',
                    headers: {"X-HTTP-Method-Override": "PUT"},
                    success:function (data) {
                        alert(data.success);
                        window.location.reload();
                    }
                })
            }
        })

        $('.update-non-graduated').click(function () {
            if (confirm('Bạn muốn thực hiện hành động này?')){
                $.ajax({
                    url:  '{{asset("api/sinhvien/update_status")}}' +'/' +$(this).attr('data-id')+ '?totnghiep_status=3',
                    type: 'post',
                    dataType: 'json',
                    headers: {"X-HTTP-Method-Override": "PUT"},
                    success:function (data) {
                        alert(data.success);
                        window.location.reload();
                    }
                })
            }
        })
    });
</script>
