
<!DOCTYPE html>
<html>
@yield('head')

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">


@yield('aside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    @yield('content')

  </div>

  @include('backOffice.inc/footer')

  <div class="control-sidebar-bg"></div>
</div>


@yield('scripts')


</body>
</html>
