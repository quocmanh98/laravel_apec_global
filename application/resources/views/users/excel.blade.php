@php
use App\Models\Admin\Degree;
use App\Models\Admin\Department;
use App\Models\Admin\District;
use App\Models\Admin\Level;
use App\Models\Admin\Marriages;
use App\Models\Admin\Nation;
use App\Models\Admin\Nationality;
use App\Models\Admin\Position;
use App\Models\Admin\Province;
use App\Models\Admin\Religion;
use App\Models\Admin\Specialize;
use App\Models\Admin\Typeofemployees;
use App\Models\Admin\Ward;
use App\Models\Role;
$marriages = Marriages::all();
$districts = District::all();
$wards = Ward::all();
$provinces = Province::all();
$nationality = Nationality::all();
$religions = Religion::all();
$roles = Role::all();
$departments = Department::all();
$nation = Nation::all();
$positions = Position::all();
$typeofemployees = Typeofemployees::all();
$levels = Level::all();
$degrees = Degree::all();
$specializes = Specialize::all();

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered verticle-middle table-responsive-sm">
                <thead style="text-align: center">
                    <tr>
                        <th scope="col"> # </th>
                        <th scope="col">Giới Tính</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Điện thoại</th>
                        <th scope="col">Ngày sinh</th>
                        <th>
                            Tình trạng hôn nhân
                        </th>
                        <th>Quốc tịch</th>
                        <th>Tôn giáo</th>
                        <th>Dân tộc</th>
                        <th>Số CMND/CCCD</th>
                        <th>Nơi cấp CMND/CCCD</th>
                        <th>Ngày cấp CMND/CCCD</th>
                        <th>Địa chỉ thường trú</th>
                        <th>Nơi ở hiện tại</th>
                        <th>Trình độ</th>
                        <th>Bằng cấp</th>
                        <th>Chuyên môn</th>
                        <th>Phòng ban</th>
                        <th>Chức vụ</th>
                        <th>Vị trí công việc</th>
                        <th>Loại nhân viên</th>
                        <th>Ngày vào làm</th>
                        <th scope="col">Trạng thái duyệt</th>
                        <th scope="col">Trạng thái đi làm</th>
                    </tr>
                </thead>
                <tbody style="text-align: center">
                    @php
                        $t = 1;
                    @endphp
                    @foreach ($users as $k => $v)
                            <tr>
                                <td scope="row">{{ $t++ }}</td>
                                <td>
                                    @if ($v->gioi_tinh == 0)
                                        Nam
                                    @else
                                        Nữ
                                    @endif
                                </td>
                                <td>{{ $v->fullname }}</td>
                                <td>{{ $v->email }}</td>
                                <td>{{ $v->phone }}</td>
                                <td>
                                    {{ $v->birthday }}
                                </td>
                                <td>
                                    @foreach ($marriages as $k)
                                        @if ($k->id == $v->hon_nhan_id)
                                            {{ $k->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($nationality as $k)
                                        @if ($k->id == $v->quoc_tich)
                                            {{ $k->nationalitys_name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($religions as $k)
                                        @if ($k->id == $v->ton_giao)
                                            {{ $k->religions_name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($nation as $k)
                                        @if ($k->id == $v->dan_toc_id)
                                            {{ $k->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{ $v->so_cmnd }}
                                </td>
                                <td>
                                    {{ $v->noi_cap_cmnd }}
                                </td>
                                <td>
                                    {{ $v->ngay_cap_cmnd }}
                                </td>
                                <td>
                                    {{ $v->nguyen_quan }}
                                </td>
                                <td>
                                    {{ $v->tam_tru }}
                                    {{-- Nơi ở hiện tại --}}
                                </td>
                                <td>
                                    @foreach ($levels as $k)
                                    @if ($k->id == $v->trinh_do_id)
                                        {{ $k->levels_name }}
                                    @endif
                                @endforeach
                                </td>
                                <td>
                                    @foreach ($degrees as $k )
                                            @if ($k->id == $v->bang_cap_id)
                                                {{ $k->degrees_name }}
                                            @endif
                                        @endforeach
                                </td>
                                <td>
                                    @foreach ($specializes  as $k)
                                        @if ($k->id == $v->chuyen_mon_id )
                                            {{ $k->specializes_name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($departments as $k)
                                        @if ($k->id == $v->phong_ban_id)
                                            {{ $k->departments_name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($positions as $k)
                                        @if ($k->id == $v->chuc_vu_id)
                                            {{ $k->positions_name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{ $v->recruitment }}
                                </td>
                                <td>
                                    @foreach ($typeofemployees as $k)
                                    @if ($k->id == $v->loai_nv_id)
                                        {{ $k->typeofemployeess_name }}
                                    @endif
                                @endforeach
                                </td>
                                <td>
                                    {{$v->dayin}}
                                </td>
                                <td>
                                    @if($v->ApprovalStatus == 2)
                                        Đã duyệt
                                    @else
                                        Chờ duyệt
                                    @endif
                                </td>
                                <td>
                                    @if ($v->status_work == 2)
                                        <span class="badge badge-primary"> Đang làm việc </span>
                                    @else
                                        <span class="badge badge-danger"> Đã nghỉ việc </span>
                                    @endif
                                </td>

                            </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
