@php
    use App\Models\Role;
    $role = Role::all();
@endphp
    @if (session('roles_id') == '7ba82073-b780-4393-992f-ec33d3046047')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav font-weight-bold ">
                <h2 class='mr-1'><b>Quản lý</b></h2>
                <a class="nav-item nav-link" href="{{ route('users.index') }}">Nhân Viên</a>
                <a class="nav-item nav-link" href="{{ route('roles.index') }}">Vai trò</a>
                <a class="nav-item nav-link" href="{{ route('permissions.index') }}">Phân quyền</a>
                <a class="nav-item nav-link" href="{{ route('admin.department.index') }}">Phòng ban</a>
                <a class="nav-item nav-link" href="{{ route('admin.position.index') }}">Chức vụ</a>
                <a class="nav-item nav-link" href="{{ route('admin.level.index') }}">Trình độ</a>
                <a class="nav-item nav-link" href="{{ route('admin.specialize.index') }}">Chuyên môn</a>
                <a class="nav-item nav-link" href="{{ route('admin.degree.index') }}">Bằng cấp</a>
                <a class="nav-item nav-link" href="{{ route('admin.typeofemployees.index') }}">Loại nhân viên</a>
            </div>
        </div>
    </nav>
    @endif

