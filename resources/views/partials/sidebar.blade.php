<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!-- Sidebar Brand -->
  <div class="sidebar-brand">
    <a href="{{ url('/') }}" class="brand-link">
      <span class="brand-text fw-light">QL Sinh Viên, Giảng Viên</span>
    </a>
  </div>

  <!-- Sidebar Wrapper -->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

        {{-- Chỉ admin mới có --}}
        @if(Auth::user()->role == 'admin')
        <li class="nav-item">
          <a href="{{ route('academic_years.index') }}" class="nav-link">
            <i class="bi bi-calendar-event nav-icon"></i>
            <p>Quản lý Năm học</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('departments.index') }}" class="nav-link">
            <i class="bi bi-building nav-icon"></i>
            <p>Quản lý Khoa</p>
          </a>
        </li>        
        @endif

        <li class="nav-item">
          <a href="{{ route('classes.index') }}" class="nav-link">
            <i class="bi bi-people-fill nav-icon"></i>
            <p>Quản lý Lớp học</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('courses.index') }}" class="nav-link">
            <i class="bi bi-journal-bookmark nav-icon"></i>
            <p>Quản lý Môn học</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('students.index') }}" class="nav-link">
            <i class="bi bi-mortarboard-fill nav-icon"></i>
            <p>Quản lý Sinh viên</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('grades.index') }}" class="nav-link">
            <i class="bi bi-clipboard-check nav-icon"></i>
            <p>Quản lý Điểm</p>
          </a>
        </li>
        @if(Auth::user()->role == 'admin')
        <li class="nav-item">
          <a href="{{ route('teachers.index') }}" class="nav-link">
            <i class="bi bi-person-badge-fill nav-icon"></i>
            <p>Quản lý Giảng viên</p>
          </a>
        </li>
        @endif

       <li class="nav-item">
          <a href="{{ route('student.grades') }}" class="nav-link">
            <i class="bi bi-clipboard-check nav-icon"></i>
            <p>Xem Điểm</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>
