<!DOCTYPE html>
<html>
@include('layouts._head')

@yield('extra_style')
<body>
  <div class="wrapper">

    @include('layouts._topbar')

    @yield('content')

    @include('layouts._footer')

  </div>
@include('layouts._script')

@yield('extra_script')
</body>
</html>
