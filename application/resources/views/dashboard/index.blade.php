<style>
    .table tbody tr td:nth-child(2) img {
        width: 80px;
        height: 100px;
        object-fit: cover;
    }

</style>
@extends('layouts.app')

@section('page_title', __('Quản Trị Nhân Sự'))
@php
use Illuminate\Support\Facades\DB;
$total_people = DB::table('users')
    ->where('ApprovalStatus', 2)
    ->count();
$total_department = DB::table('departments')->count();
$total_position = DB::table('positions')->count();
$total_level = DB::table('users')
    ->where('status_work', 2)
    ->where('ApprovalStatus', 2)
    ->count();
@endphp
@section('page')
    <div class="row">

        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body">
                    <div class="media ai-icon">
                        <span class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">@lang('Nhân viên')</p>
                            <h4 class="mb-0">{{ $total_people }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body">
                    <div class="media ai-icon">
                        <span class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-user-plus">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">@lang('Phòng ban')</p>
                            <h4 class="mb-0">{{ $total_department }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body">
                    <div class="media ai-icon">
                        <span class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-user-x">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="18" y1="8" x2="23" y2="13"></line>
                                <line x1="23" y1="8" x2="18" y2="13"></line>
                            </svg>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">@lang('Chức vụ')</p>
                            <h4 class="mb-0">{{ $total_position }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body">
                    <div class="media ai-icon">
                        <span class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">@lang('Nhân viên đang làm việc')</p>
                            <h4 class="mb-0">{{ $total_level }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row ">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-1">{{ __('Danh sách phòng ban') }}</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered verticle-middle table-responsive-sm" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col"> # </th>
                                <th scope="col">Mã phòng</th>
                                <th scope="col">Tên phòng</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($department->total() > 0)
                                @php
                                    $t = 1;
                                @endphp
                                @foreach ($department as $k => $v)
                                    <tr>
                                        <th scope="row">{{ $t++ }}</th>
                                        <td>{{ $v->departments_code }}</td>
                                        <td>{{ $v->departments_name }}</td>
                                        <td>
                                            <div class="form-group col-md-6">
                                                @if ($v->departments_status == 1)
                                                    <span class="badge badge-primary">Hiện</span>
                                                @else
                                                    <span class="badge badge-danger">Ẩn</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="alert alert-primary">
                                    <td colspan="7">
                                        <p>Không tìm thấy bản ghi !</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $department->links() }}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h4 class="card-title ">{{ __('Danh sách chức vụ') }}</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered verticle-middle table-responsive-sm" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col"> # </th>
                                <th scope="col">Mã chức vụ</th>
                                <th scope="col">Tên chức vụ</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($position->total() > 0)
                                @php
                                    $t = 1;
                                @endphp
                                @foreach ($position as $k => $v)
                                    <tr>
                                        <th scope="row">{{ $t++ }}</th>
                                        <td>{{ $v->positions_code }}</td>
                                        <td>{{ $v->positions_name }}</td>
                                        <td>
                                            <div class="form-group col-md-6">
                                                @if ($v->positions_status == 1)
                                                    <span class="badge badge-primary">Hiện</span>
                                                @else
                                                    <span class="badge badge-danger">Ẩn</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="alert alert-primary">
                                    <td colspan="7">
                                        <p>Không tìm thấy bản ghi !</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $position->links() }}
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0">
                        Danh sách nhân viên
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="text-align: center">
                            <thead>
                                <tr>
                                    <th scope="col"> # </th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Phòng ban</th>
                                    <th scope="col">Chức vụ</th>
                                    <th scope="col">Vị trí công việc</th>
                                    <th scope="col">Trạng thái nhân viên</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($item->total() > 0)
                                    @if (!empty($item))
                                        @php
                                            $t = 1;
                                        @endphp
                                        @foreach ($item as $k => $v)
                                            @if ($v->ApprovalStatus == 2)
                                            <tr>
                                                <td scope="row">{{ $t++ }}</td>
                                                <td><img src="{{ url('/') }}/{{ $v->avatar }}" alt=""></td>
                                                <td>{{ $v->fullname }}</td>
                                                <td>
                                                    @foreach ($department as $key => $value)
                                                        @if ($value->id == $v->phong_ban_id)
                                                            {{ $value->departments_name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($position as $key => $value)
                                                        @if ($value->id == $v->chuc_vu_id)
                                                            {{ $value->positions_name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ $v->recruitment }}
                                                </td>
                                                <td>
                                                    @if ($v->status_work == 2)
                                                        <span class="badge badge-primary"> Đang làm việc</span>
                                                    @else
                                                        <span class="badge badge-danger"> Đã nghỉ việc</span>
                                                    @endif
                                                </td>

                                            </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr class="alert alert-primary">
                                            <td colspan="7">
                                                <p>Không tìm thấy bản ghi !</p>
                                            </td>
                                        </tr>
                                    @endif
                                @else
                                    <tr class="alert alert-primary">
                                        <td colspan="7">
                                            <p>Không tìm thấy bản ghi !</p>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                </form>
                <div class="card-footer">
                    <div class="float-right">
                        {{-- {{ $typeofemployees->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>



    </div>
@endsection


@push('footer')
    <script src="{{ asset('assets/js/Chart.bundle.min.js') }}"></script>
    <script>
        var chartjs = {
            label: @json(array_keys($registrationHistory)),
            value: @json(array_values($registrationHistory))
        }

        var loginPieChart = @json($loginPieChart);
    </script>

    <script>
        $(document).ready(function() {
            var productBuy = $('#containers').data('order');
            var chartData = [];
            console.log(productBuy);
            productBuy.forEach(function(element) {
                console.log(element);
                var ele = {
                    name: element.name,
                    y: parseFloat(element.y)
                };
                chartData.push(ele);
            });
            console.log(chartData);
            Highcharts.chart('containers', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Daily order'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: chartData,
                }]
            });
        });
    </script>
@endpush
