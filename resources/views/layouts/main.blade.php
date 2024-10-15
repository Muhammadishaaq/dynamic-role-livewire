<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.components.header')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.components.nav')

        <!-- Main Sidebar Container -->
        @include('layouts.components.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Use Blade component's default slot for dynamic content -->
            <main class="py-4">
                {{ $slot }}
            </main>
        </div>

        <!-- Footer -->
        @include('layouts.components.footer')
    </div>

    <!-- Scripts -->
    @include('layouts.components.scriptpart')
</body>

</html>
