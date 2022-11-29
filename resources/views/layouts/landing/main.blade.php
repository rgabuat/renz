
<!DOCTYPE html>
<html lang="en">
    
@include('layouts.landing.head')
@yield('css')
<body class="hold-transition ">
@include('layouts.landing.header')
<div class="container">
@include('includes.flash-message')
</div>

@yield('content')
<!-- REQUIRED SCRIPTS -->
@include('layouts.landing.footer')
<!-- jQuery -->
<script src="{{ asset('vendors/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('vendors/dist/js/adminlte.js') }}"></script>

@yield('javascript')
</body>
</html>
