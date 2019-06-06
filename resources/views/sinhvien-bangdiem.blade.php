<table class="table table-bordered">
    <th>Stt</th>
    <th>Môn Học</th>
<!--    <th>Tín chỉ</th>-->
<!--    <th>Hệ số</th>-->
    <th>Điểm tổng kết</th>
    @foreach($bangdiem as $bd)
        <tr>
            <td>{{$bd->id}}</td>
            <td style="text-align: left">{{$bd->id_mh}}</td>
            <td>{{$bd->diemtk}}</td>
<!--            <td>{{$bd->heso}}</td>-->
<!--            <td>{{$bd->status}}</td>-->
        </tr>
        @endforeach

</table>