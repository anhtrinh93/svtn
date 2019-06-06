<table class="table table-bordered">
    <th>Stt</th>
    <th>Môn Học</th>
    <th>Tín chỉ</th>
    <th>Hệ số</th>
    <th>Điểm tổng kết</th>
    <th>Trạng thái</th>
    @foreach($bangdiem as $bd)
        <tr>
            <td>{{$bd->id}}</td>
            <td style="text-align: left">{{$bd->monhoc->tenmon}}</td>
            <td>{{$bd->monhoc->tinchi}}</td>
            <td>{{$bd->monhoc->heso}}</td>
            <td>{{$bd->diemtk}}</td>
            <td>{{$bd->diemtk < 4 ? "Không hoàn thành" : "Hoàn thành"}}</td>
        </tr>
        @endforeach

</table>
