 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard')}}" class="brand-link">
      <img src="{{ asset('vendors/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Login System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <a href="{{ route('view-profile') }}">
          <div class="image">
            <img src="{{ asset('storage/'.auth()->user()->profile_image) }}" alt="avatar">
          </div>
          <div class="info">
            <a href="{{ route('view-profile') }}" class="d-block">@auth {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} @endauth</a>
          </div>
        </a>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                 Dashboard
              </p>
            </a>
          </li>
          @role('system admin|system editor|system user')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                 Users Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <!-- <li class="nav-item">
                <a href="{{ route('users/sub-accounts') }}" class="nav-link">
                  <i class="pl-3 nav-icon fas fa-eye"></i>
                  <p class="pl-3">
                    View Sub Accounts
                  </p>
                </a>
              </li> -->
            @role('system admin|system editor|system user')
              <li class="nav-item">
                <a href="{{ route('users/list') }}" class="nav-link">
                  <i class="pl-3 nav-icon fas fa-eye"></i>
                  <p class="pl-3">
                    View All Users
                  </p>
                </a>
              </li>
              @role('system admin|system editor')
              <li class="nav-item">
                <a href="{{ route('users/create') }}" class="nav-link">
                  <i class="pl-3 nav-icon fas fa-user-plus"></i>
                  <p class="pl-3">
                    Add User
                  </p>
                </a>
              </li>
              @endrole
              @endrole
            </ul>
          </li>
          @endrole
          @role('system admin|system editor|system user|company admin')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-database"></i>
                <p>
                  Data Management
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('data/list') }}" class="nav-link">
                    <i class="pl-3 nav-icon fas fa-eye"></i>
                    <p class="pl-3">
                      View All Data
                    </p>
                  </a>
                </li>
                @role('system admin|system editor')
                <li class="nav-item">
                  <a href="{{ route('data/import') }}" class="nav-link">
                    <i class="pl-3 nav-icon fas fa-plus"></i>
                    <p class="pl-3">
                      Import Data
                    </p>
                  </a>
                </li>
                @endrole
              </ul>
            </li>
            @endrole
            @role('system admin|system editor|company admin|company user|system user')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
                <p>
                  Company
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @role('system admin|system editor|system user')
                <li class="nav-item">
                  <a href="{{ route('company/list') }}" class="nav-link">
                    <i class="pl-3 nav-icon fas fa-eye"></i>
                    <p class="pl-3">
                      View All Company
                    </p>
                  </a>
                </li>
                @endrole
                @role('company user|company admin')
                <li class="nav-item">
                  <a href="{{ route('company/sub-accounts') }}" class="nav-link">
                    <i class="pl-3 nav-icon fas fa-eye"></i>
                    <p class="pl-3">
                      View Accounts
                    </p>
                  </a>
                </li>
                @endrole
                  @role('company admin|system admin|system editor')
                  <li class="nav-item">
                    <a href="{{ route('company/create') }}" class="nav-link">
                      <i class="pl-3 nav-icon fas fa-plus"></i>
                      <p class="pl-3">
                        Add Company Accounts
                      </p>
                    </a>
                  </li>
                  @endrole
                </ul>
              </li>
            @endrole
          <li class="nav-item">
            <a href="{{route('view-profile')}}" class="nav-link">
              <i class="nav-icon fas fa-eye"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('change-password') }}" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
