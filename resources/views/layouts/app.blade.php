<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hashmicro Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  </head>
<body>
    
<main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <div class="container">
          <div class="d-flex align-items-center">
              <a href="/" class="text-dark text-decoration-none me-3">
                  <img src="{{asset('Hashmicro_logo.png')}}" alt="Logo" width="150">
              </a>
  
              <nav class="d-flex gap-3">
                  <a href="{{route('index')}}" class="nav-link text-dark">Product</a>
                  @role('admin')
                      <a href="{{route('admin.category.index')}}" class="nav-link text-dark">Categories</a>
                      <a href="{{route('admin.user.index')}}" class="nav-link text-dark">Users</a>
                  @endrole
                  <a href="{{route('input-feature')}}" class="nav-link text-dark">Input Feature</a>
              </nav>
  
              <div class="ms-auto">
                  <a class="btn btn-outline-danger" href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
          </div>
      </div>
    </header>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </div>
</main>

</body>
</html>