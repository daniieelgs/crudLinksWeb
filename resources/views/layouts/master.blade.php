<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
    @yield('css')
    <title>@yield('title')</title>
</head>
<body>
    
    <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">Inici</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse" id="navbarsExample02">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/web">Webs</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/web/create">Crear</a>
              </li>
            </ul>
            <form role="search" class="form-search" action="/web">
              <input class="form-control" type="search" placeholder="Search" id="searchInput" name="s" aria-label="Search" value = "@if(isset($search)){{$search}}@endif">

              <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
          </div>
        </div>

        <div style="display: flex; width: 150px; gap: 10px; color: rgb(128, 128, 128)">

          @if ($username == null)
            <a href="login" style="color: inherit">Log in</a>

            <a href="register" style="color: inherit">Register</a>
          @else
            <a href="/dashboard" style="color: inherit">{{$username->name}}</a>
          @endif

        </div>
      </nav>

      @yield('modal')

      @yield('content')

      <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
              <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
            </a>
            <span class="mb-3 mb-md-0 text-muted">© 2022 Company, Inc</span>
          </div>
      
        </footer>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

      @yield('script')

    </body>
</html>