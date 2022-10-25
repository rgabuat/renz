
<!DOCTYPE html>
<html lang="en">
@include('layouts.landing.head')
<body class="hold-transition ">
@include('layouts.landing.header')
@yield('content')
<!-- REQUIRED SCRIPTS -->
@include('layouts.landing.footer')
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
