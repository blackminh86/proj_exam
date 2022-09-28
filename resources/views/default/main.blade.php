<!DOCTYPE html>
<html lang="vi">
<head>
    @include('default.elements.session')
    @include('default.elements.head')
</head>
<body class="cnt-home">
    <header class="header-style-1">
    @include('default.elements.header')
    </header>
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
    @yield('content')
    @include('default.elements.brands')
        </div>
    </div>
    @include('default.elements.footer')
    @include('default.elements.script')
</body>
</html>