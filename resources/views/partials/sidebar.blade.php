<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            
             
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Quản Lý Sinh Viên,Giảng Viên</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
            <li class="nav-item">
            <a href="{{ route('academic_years.index') }}" class="nav-link">
              <i class="nav-icon bi bi-table"></i>
              <p>
                Quản lý năm học
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
              
            </a>
             <a href="{{ route('departments.index') }}" class="nav-link">
              <i class="nav-icon bi bi-table"></i>
              <p>
                Quản lý Khoa
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>              
            </a>
            <a href="{{ route('classes.index') }}" class="nav-link">
              <i class="nav-icon bi bi-table"></i>
              <p>
                Quản lý Lớp Học
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>             
            </a>
            <a href="{{ route('courses.index') }}" class="nav-link">
              <i class="nav-icon bi bi-table"></i>
              <p>
                Quản lý Môn học
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>             
            </a>
             <a href="{{ route('students.index') }}" class="nav-link">
              <i class="nav-icon bi bi-table"></i>
              <p>
                Quản lý Sinh Viên
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>             
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./tables/simple.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">EXAMPLES</li>

          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon bi bi-box-arrow-in-right"></i>
              <p>
                Đăng Xuất
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>                
          </li>
                         
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>