<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link sidebar-toggle-btn d-lg-none" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item d-flex align-items-center">
             <a>{{ Auth::user()->name }}</a> <a class="nav-link" title="Logout" data-toggle="modal" data-target="#logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
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
      <h2><img src="https://testwebsite.thegoproject.me/assets/img/goimage/the-go-project-.svg" /></h2>
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


                    <li class="nav-item @if (Route::currentRouteName() == 'admin.home.background' || Route::currentRouteName() == 'admin.home.video'
                     || Route::currentRouteName() == 'admin.home.client' || Route::currentRouteName() == 'admin.home.animationtext' || Route::currentRouteName() == 'admin.home.testimonials') 
                      menu-open @endif">
                        <a href="#" class="nav-link @if (Route::currentRouteName() == 'admin.home.background' || Route::currentRouteName() == 'admin.home.video'
                     || Route::currentRouteName() == 'admin.home.client' || Route::currentRouteName() == 'admin.home.animationtext' || Route::currentRouteName() == 'admin.home.testimonials') active @endif">
                        <i class="fas fa-home"></i>
                            <p>
                         Home 
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Route('admin.home.background') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'admin.home.background') active @endif">
                                    <p>Background</p>
                                </a>
                            </li>
                   
                            <li class="nav-item">
                                <a href="{{ Route('admin.home.video') }}"
                                    class="nav-link @if(Route::currentRouteName() == 'admin.home.video') active @endif">
                                    <p>Video</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ Route('admin.home.client') }}"
                                    class="nav-link @if(Route::currentRouteName() == 'admin.home.client') active @endif">
                                    <p>Client</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ Route('admin.home.testimonials') }}"
                                    class="nav-link @if(Route::currentRouteName() == 'admin.home.testimonials') active @endif">
                                    <p>Testimonials</p>
                                </a>
                            </li>

                            
                            <li class="nav-item">
                                <a href="{{ Route('admin.home.animationtext') }}"
                                    class="nav-link @if(Route::currentRouteName() == 'admin.home.animationtext') active @endif">
                                    <p>Animation Text</p>
                                </a>
                            </li>

</ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ Route('admin.about') }}"
                            class="nav-link @if (Route::currentRouteName() == 'admin.about') active @endif">
                            <i class="fas fa-info-circle"></i>
                            <p>
                               About
                            </p>
                        </a>
                    </li>

                    <li class="nav-item @if (Route::currentRouteName() == 'admin.home.project.category' || Route::currentRouteName() == 'admin.home.projects') 
                      menu-open @endif">
                        <a href="#" class="nav-link @if (Route::currentRouteName() == 'admin.home.project.category' || Route::currentRouteName() == 'admin.home.projects') active @endif">
                        <i class="fas fa-tasks"></i> 
                            <p>
                         Projects
                                <i class="fas fa-angle-left right"></i>
                            </p> 
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                                <a href="{{ Route('admin.home.project.category') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'admin.home.project.category') active @endif">
                              <p>Projects Categories</p>
                                </a>
                        </li>

                            <li class="nav-item">
                                <a href="{{ Route('admin.home.projects') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'admin.home.projects') active @endif">
                                  <p>Projects</p>
                                </a>
                            </li>
          
</ul>
</li>

<li class="nav-item @if (Route::currentRouteName() == 'admin.agency.agency' || Route::currentRouteName() == 'admin.agency.members' || Route::currentRouteName() == 'admin.agency.banner') 
                      menu-open @endif">
                        <a href="#" class="nav-link @if (Route::currentRouteName() == 'admin.agency.agency' || Route::currentRouteName() == 'admin.agency.members' || Route::currentRouteName() == 'admin.agency.banner') active @endif">
                        <i class="fas fa-users"></i>
                            <p>
                      Agency
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Route('admin.agency.agency') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'admin.agency.agency') active @endif">
                                    <p>Agency</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ Route('admin.agency.members') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'admin.agency.members') active @endif">
                                    <p>Members</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Route('admin.agency.images') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'admin.agency.images') active @endif">
                                    <p>Agency Images</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ Route('admin.agency.slider') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'admin.agency.slider') active @endif">
                                    <p>Slider</p>
                                </a>
                            </li>

</ul>
</li>


<li class="nav-item @if (Route::currentRouteName() == 'admin.services.category' || Route::currentRouteName() == 'admin.services') 
                      menu-open @endif">
                        <a href="#" class="nav-link @if (Route::currentRouteName() == 'admin.services.category' || Route::currentRouteName() == 'admin.services') active @endif">
                        <i class="fa fa-gift"></i>
                            <p>
                      services
                                <i class="fas fa-angle-left right"></i>
                            </p> 
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                                <a href="{{ Route('admin.services.category') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'admin.services.category') active @endif">
                              <p>Services  Name</p>
                                </a>
                        </li>
                        <li class="nav-item">
                                <a href="{{ Route('admin.services') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'admin.services') active @endif">
                              <p>Services</p>
                                </a>
                        </li>
                   
          
</ul>
</li>

                    <li class="nav-item">
                        <a href="{{ Route('admin.casestudies.index') }}"
                            class="nav-link @if (Route::currentRouteName() == 'admin.casestudies.index') active @endif">
                            <i class="fas fa-dice-d6"></i>
                            <p>
                               Case Studies
                            </p>
                        </a>
                    </li>

<li class="nav-item">
                        <a href="{{ Route('admin.blog') }}"
                            class="nav-link @if (Route::currentRouteName() == 'admin.blog') active @endif">
                            <i class="fas fa-blog"></i>
                            <p>
                               Blogs
                            </p>
                        </a>
                    </li>

<li class="nav-item">
                        <a href="{{ Route('admin.contact') }}"
                            class="nav-link @if (Route::currentRouteName() == 'admin.contact') active @endif">
                            <i class="fas fa-id-card"></i>
                            <p>
                                Contact Us
                            </p>
                        </a>
                    </li>

         
            </nav>
        </div>
    </aside>
