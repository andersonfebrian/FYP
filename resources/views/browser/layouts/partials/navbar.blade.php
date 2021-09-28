<nav class="navbar navbar-expand-lg navbar-light bg-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand text-white mr-auto" href="{{ route('browser.index') }}" >MARKET PLACE</a>
    <div class="ml-auto mr-auto justify-content-center flex">
      <form class="d-flex m-0" action="{{ route('browser.search') }}" method="POST">
        @csrf
        <input type="text" name="search" class="form-control" placeholder="Search Item...">
        <button type="submit" class="btn btn-dark ml-2 text-white">Search</button>
      </form>
    </div>
    <div class="ml-auto">
      <div class="row">
        <div class="col d-flex align-items-center">
          <a href="#"><i class="fa fa-shopping-cart fa-lg" style="color: #fff"></i></a>
        </div>
        <div class="col">
          @auth
            <div class="dropdown">
              <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdown-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Menu
              </button>
              <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="dropdown-button">
                <a class="dropdown-item" href="{{ route('browser.profile') }}"><span class="fa fa-user"></span> Profile</a>
                <a class="dropdown-item" href="{{ route('browser.store-dashboard') }}"><span class="fas fa-store-alt"></span> Store</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('browser.logout') }}"><i class="fa fa-sign-out-alt"></i> Logout</a>
              </div>
            </div>
          @endauth
          @guest
            <a href="{{ route('browser.login.show') }}" class="btn btn-primary">Login</a>
          @endguest
        </div>
      </div>
    </div>
  </div>
</nav>