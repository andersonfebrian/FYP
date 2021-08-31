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
      @auth
        <a href="{{ route('browser.profile') }}" class="btn btn-secondary">Profile</a>
        <a href="{{ route('browser.logout') }}" class="btn btn-primary">Logout</a>
      @endauth
      @guest
        <a href="{{ route('browser.login.show') }}" class="btn btn-primary">Login / Register</a>
      @endguest
    </div>
  </div>
</nav>