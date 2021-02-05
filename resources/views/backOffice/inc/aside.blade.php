<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link @if($route  == 'livres') @endif" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link @if($route  == 'livres') @endif">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link @if($route  == 'livres') @endif">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->


    <!-- Right navbar links -->

</nav>
  <!-- /.navbar -->
  <div class="xnav">

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 xnav-wrapper">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{ asset('backOffice') }}/img/3.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Ma Bibliothèque</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{ route('showAdminLivres') }}" class="nav-link @if($route  == 'livres') active @endif">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Livre
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('showAdminClients')}} " class="nav-link @if($route  == 'clients') active @endif">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Client
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="route('showAdminReservation') " class="nav-link @if($route  == 'reservation') active @endif">
              <i class="nav-icon fas fa-book-reader"></i>
              <p>
                Emprunt
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link @if($route  == 'logout') active @endif">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p> Déconnexion</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
