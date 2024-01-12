<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link sidebar-toggle-btn d-lg-none" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item d-flex align-items-center">
                <a>{{ Auth::user()->name }}</a>
                <a class="nav-link" title="Logout" data-toggle="modal" data-target="#logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown">
                    <i class="fas fa-bell"></i>
                    <span class="badge badge-danger navbar-badge">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> You have 5 new messages
                    </a>
                    <!-- Add more notification items here -->
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
        </ul>
        
    </nav>
    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alert!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <a href="{{ Route('admin.logout') }}" type="button" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->

        <!-- Sidebar -->
        <div class="sidebar mt-3">
            <!-- Sidebar user (optional) -->

            <!-- SidebarSearch Form -->
            <div class="form-inline">
      <h2><img src="https://tecomsa.me/content/assets/images/new/logo70.png" /></h2>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="true">

                    <li class="nav-item">
                        <a href="{{ Route('admin.dashboard') }}"
                            class="nav-link @if (Route::currentRouteName() == 'admin.dashboard') active @endif">
                            <i class="fas fa-chart-line"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                </ul>
         
            </nav>
        </div>
    </aside>
