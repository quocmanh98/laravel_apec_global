
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Phòng ban
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            @foreach ($department as $v)
            <a class="nav-item nav-link" href="{{ route('employee.department.filer',$v->departments_slug) }}">{{ $v->departments_name }}</a>
            @endforeach
          </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Bằng cấp
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              @foreach ($level as $v)
              <a class="nav-item nav-link" href="{{ route('employee.department.filer',$v->id) }}">{{ $v->levels_name }}</a>
              @endforeach
            </div>
          </li>
      </ul>
    </div>
  </nav>
