<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />
</head>

<body>
    @section('header')
    <header>
      <ul id="nav-mobile" class="sidenav sidenav-fixed">
          <li class="bold"><a href="{{ route('admin.user') }}" class="waves-effect waves-teal {{ (request()->segment(2) == 'user') ? 'active' : '' }}">User</a></li>
          <li class="bold"><a href="#" class="waves-effect waves-teal">Settings</a></li>
      </ul>
      <div class="navbar-fixed">
          <nav class="navbar top-menu light-blue darken-2">
              <div class="nav-wrapper"><a href="#!" class="brand-logo grey-text text-darken-4">Logo</a>
                  <ul id="nav-mobile" class="right">
                      <li><a href='#' >user</a></li>
                      <li><a class='dropdown-trigger' href='#' data-target='dropdown1'><i class="material-icons">settings</i></a></li>
                  </ul>
                  <a href="#" data-target="nav-mobile" class="top-nav sidenav-trigger waves-effect waves-light circle hide-on-large-only"><i class="material-icons">menu</i></a> </div>
          </nav>
      </div>
      <ul id='dropdown1' class='dropdown-content'>
          <li><a href="#!">one</a></li>
          <li><a href="#!">two</a></li>
          <li class="divider" tabindex="-1"></li>
          <li><a href="#!">Logout</a></li>
      </ul>
  </header>
  @show
  <main class="main-wrap">
    @yield('content')
  </main>
  @section('footer')
  <footer class="page-footer main-wrap ">
    © 2014 Copyright Text <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
    
  </footer>
  @show
</body>
<script src="{{ asset('js/admin/scripts.js') }}"></script>
@section('page_script')

@show
</html>