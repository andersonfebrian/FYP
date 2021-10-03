<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.layouts.partials.meta')
  </head>
  <body>
    
    <div class="position-relative">
      @yield('master')
    </div>

    @include('admin.layouts.partials.scripts')
  </body>
</html>