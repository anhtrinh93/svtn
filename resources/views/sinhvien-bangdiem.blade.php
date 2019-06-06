<table class="table table-bordered">
    <th>Stt</th>
    <th>Môn Học</th>
    <th>Tín chỉ</th>
    <th>Hệ số</th>
    <th>Điểm tổng kết</th>
    <th>Trạng thái</th>
    @if (sizeof($bangdiem) > 0)
        @foreach($bangdiem as $bd)
            <tr>
                <td>{{$bd->id}}</td>
                <td style="text-align: left">{{$bd->monhoc->tenmon}}</td>
                <td>{{$bd->monhoc->tinchi}}</td>
                <td>{{$bd->monhoc->heso}}</td>
                <td>{{$bd->diemtk}}</td>
                <td style="text-align: center">
                    @if ($bd->diemtk < 4)
                    <span style="color: red"> Không hoàn thành</span>
                    @else
                    <span> Hoàn thành</span>
                    @endif
                </td>
            </tr>
    @endforeach
    @else
        <tr>
            <td colspan="6" style="text-align: center">Không có điểm số môn học nào</td>
        </tr>
    @endif


</table>
