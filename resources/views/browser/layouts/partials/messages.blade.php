@if($errors->any())
  <div class="alert alert-danger mt-2">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if(session()->has('success'))
  <div class="alert alert-success">
    <p>{{session('success')}}</p>
  </div>
@endif

@if(session()->has('error'))
  <div class="alert alert-danger mt-2">
    <p>{{ session('error') }}</p>
  </div>
@endif