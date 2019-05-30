<table class="table table-bordered">
    <th>Mã Môn</th>
    <th>Môn Học</th>
    <th>Tín chỉ</th>
    <th>Hệ số</th>
    <th>Trạng thái</th>
    @foreach($kh_cn->monhoc as $mh)
        <tr>
            <td>{{$mh->mamon}}</td>
            <td style="text-align: left">{{$mh->tenmon}}</td>
            <td>{{$mh->tinchi}}</td>
            <td>{{$mh->heso}}</td>
            <td>{{$mh->pivot->status}}</td>
        </tr>
        @endforeach

</table>