<html lang="en">
<head>
  @include('browser.layouts.partials.meta')
</head>
<body>
  
  @routes

  <div class="position-relative">
    @yield('master')
  </div>

  @include('browser.layouts.partials.scripts')
</body>
</html>