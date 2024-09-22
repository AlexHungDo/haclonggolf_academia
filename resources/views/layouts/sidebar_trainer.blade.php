<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ route('schedule_details.index') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">HacLongGolf <img class="rounded-circle" src="{{asset('assets/img/logo.png')}}" alt="" style="width: 40px; height: 40px;"></h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{asset('assets/img/avatar.jpg')}}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->  name }}</h6>
                <span>
                    @if(Auth::user()->role == 1)
                        Quản lí
                    @elseif(Auth::user()->role == 2)
                        Huấn luyện viên
                    @else
                        {{ ucfirst(Auth::user()->role) }}
                    @endif
                </span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('schedule_details.index') }}" class="nav-item nav-link {{ Request::routeIs('schedule_details.index') ? 'active' : '' }}">
                <i class="fa-solid fa-clock"></i>Lịch trình
            </a>
            <a href="{{ route('schedules.index') }}" class="nav-item nav-link {{ Request::routeIs('schedules.index') ? 'active' : '' }}">
                <i class="fa-regular fa-calendar-days"></i>Tạo lịch
            </a>
            <a href="{{ route('class.index') }}" class="nav-item nav-link {{ Request::routeIs('class.index') ? 'active' : '' }}">
                <i class="fa-regular fa-calendar-days"></i>Lớp học của tôi
            </a>
            <a href="{{ route('students.index') }}" class="nav-item nav-link {{ Request::routeIs('students.index') ? 'active' : '' }}">
                <i class="fa-solid fa-graduation-cap"></i>Học viên của tôi
            </a>
            <a href="{{ route('courses.index') }}" class="nav-item nav-link {{ Request::routeIs('courses.index') ? 'active' : '' }}">
                <i class="fa-solid fa-book"></i>Khóa học
            </a>
            <a href="#" class="nav-item nav-link {{ Request::is('profile') ? 'active' : '' }}">
                <i class="fa fa-chart-bar me-2"></i>Thông tin cá nhân
            </a>
        </div>
    </nav>
</div>
