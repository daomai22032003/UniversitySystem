<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">
    
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">   
    @include('partials.header')   
    @include('partials.sidebar')
   
    <div class="content-wrapper">
        <!-- PAGE HEADER -->
        <section class="content-header">
            <div class="container-fluid">
                <h1>@yield('title')</h1>
            </div>
        </section>

        <!-- MAIN CONTENT -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

</div>
</body>
</html>
