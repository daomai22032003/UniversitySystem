<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="{{ route('home') }}" class="nav-link">Home</a>          
            </li>           
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!-- User Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->teacher->name ?? Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('teacher.profile') }}">
                            <i class="bi bi-person me-2"></i> Thông tin cá nhân
                        </a>
                    </li> 
                <li>
                    <a class="dropdown-item" href="{{ route('password.change') }}">
                        <i class="bi bi-key me-2"></i> Đổi mật khẩu
                    </a>
                </li>
                  
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!--end::End Navbar Links-->
    </div>
    
</nav>
