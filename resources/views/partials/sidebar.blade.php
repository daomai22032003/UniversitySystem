<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">       
   
    <div class="sidebar-brand">          
        <a href="{{ url('/') }}" class="brand-link">                                    
            <span class="brand-text fw-light">Sinh Viên</span>           
        </a>          
    </div>        
   
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
                id="navigation">

                <li class="nav-item">
                    <a href="{{ route('academic_years.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-table"></i>                 
                        <p>Quản lý năm học</p>
                    </a>
                </li>                     
            </ul>
        </nav>                             
    </div>
</aside>
