<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>

    <div class="d-none d-md-flex ms-4">
        <input class="form-control border-0" type="search" placeholder="Tìm kiếm">
    </div>

    <!-- Thêm chữ ADMIN -->
    <div class="d-flex align-items-center ms-4 text-light fw-bold d-none d-md-block">
        HLV
    </div>

    <!-- Nút thời khóa biểu -->
    <div class="d-flex align-items-center ms-4 text-light fw-bold d-none d-md-block">
        <a href="{{ route('schedule_details.create') }}" class="btn">
            <i class="fa fa-calendar"></i> <!-- Icon bảng -->
        </a>
    </div>

    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-envelope me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Tin nhắn</span>
            </a>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Thông báo</span>
            </a>
        </div>
        <div class="dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="rounded-circle me-lg-2" src="{{ asset('assets/img/avatar.jpg') }}" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Thông tin cá nhân</a></li>
                <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Đăng xuất</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
