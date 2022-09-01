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
            <img src=" {{ auth()->user()->profile_image != '' ? asset('storage/'.auth()->user()->profile_image) : '/vendors/dist/img/AdminLTELogo.png' }}" alt="avatar">
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
            <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active open' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt" ></i>
              <p>
                 Dashboard
              </p>
            </a>
          </li>
          @role('system admin|system editor|system user')
          <li class="nav-item  {{ Request::is('users*') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('users*') ? 'active' : '' }} ">
              <i class="nav-icon fas fa-users "></i>
              <p>
                 Users Management
                <i class="right fas fa-angle-left "></i>
              </p>
            </a>
            <ul class="nav nav-treeview {{ Request::is('users*') ? 'd-block' : '' }}">
            @role('system admin|system editor|system user')
              <li class="nav-item">
                <a href="{{ route('users/list') }}" class="nav-link {{ Request::is('users/list*') ? 'active open' : '' }}">
                  <i class="pl-3 nav-icon fas fa-eye"></i>
                  <p class="pl-3">
                    View All Users
                  </p>
                </a>
              </li>
              @role('system admin|system editor')
              <li class="nav-item">
                <a href="{{ route('users/create') }}" class="nav-link {{ Request::is('users/create*') ? 'active open' : '' }}">
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
          @role('system admin|system editor|system user|company admin|company user')
            <li class="nav-item {{ Request::is('domain*') ? 'menu-is-opening menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('domain*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-globe"></i>
                <p>
                  Domain Management
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('domain/list') }}" class="nav-link {{ Request::is('domain/list*') ? 'active' : '' }}">
                    <i class="pl-3 nav-icon fas fa-eye"></i>
                    <p class="pl-3">
                      View All Domains
                    </p>
                  </a>
                </li>
                @role('system admin|system editor')
                <li class="nav-item">
                  <a href="{{ route('domain/create') }}" class="nav-link {{ Request::is('domain/create*') ? 'active' : '' }} ">
                    <i class="pl-3 nav-icon fas fa-plus"></i>
                    <p class="pl-3">
                      Create new Domain
                    </p>
                  </a>
                </li>
                @endrole
                @role('system admin|system editor')
                <li class="nav-item">
                  <a href="{{ route('domain/import') }}" class="nav-link {{ Request::is('domain/import*') ? 'active' : '' }}">
                    <i class="pl-3 nav-icon fas fa-file-import"></i>
                    <p class="pl-3">
                      Import Domains
                    </p>
                  </a>
                </li>
                @endrole
              </ul>
            </li>
            @endrole
            @role('system admin|system editor|company admin|company user|system user')
            <li class="nav-item {{ Request::is('company*') ? 'menu-is-opening menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('company*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-building"></i>
                <p>
                  Company
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @role('system admin|system editor|system user')
                <li class="nav-item">
                  <a href="{{ route('company/list') }}" class="nav-link {{ Request::is('company/list*') ? 'active' : '' }}">
                    <i class="pl-3 nav-icon fas fa-eye"></i>
                    <p class="pl-3">
                      View All Company
                    </p>
                  </a>
                </li>
                @endrole
                @role('company user|company admin')
                <li class="nav-item">
                  <a href="{{ route('company/sub-accounts') }}" class="nav-link {{ Request::is('company/sub-accounts') ? 'active' : '' }}">
                    <i class="pl-3 nav-icon fas fa-eye"></i>
                    <p class="pl-3">
                      View Accounts
                    </p>
                  </a>
                </li>
                @endrole
                  @role('company admin|system admin|system editor')
                  <li class="nav-item">
                    <a href="{{ route('company/create') }}" class="nav-link {{ Request::is('company/create*') ? 'active' : '' }}">
                      <i class="pl-3 nav-icon fas fa-plus"></i>
                      <p class="pl-3">
                        Create  Account
                      </p>
                    </a>
                  </li>
                  @endrole
                </ul>
              </li>
            @endrole
            @role('company admin|company user|system admin|system user')
            <li class="nav-item  {{ Request::is('article*') ? 'menu-is-opening menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('article*') ? 'active' : '' }} ">
                <i class="nav-icon fas fa-newspaper "></i>
                <p>
                  Articles
                  <i class="right fas fa-angle-left "></i>
                </p>
              </a>
              <ul class="nav nav-treeview {{ Request::is('article*') ? 'd-block' : '' }}">
                <li class="nav-item">
                  <a href="{{ route('article/lists') }}" class="nav-link {{ Request::is('article/lists*') ? 'active open' : '' }}">
                    <i class="pl-3 nav-icon fas fa-eye"></i>
                    <p class="pl-3">
                      View Articles
                    </p>
                  </a>
                </li>
                @role(' admin| user')
                <li class="nav-item">
                  <a href="{{ route('article/order') }}" class="nav-link {{ Request::is('article/order') ? 'active open' : '' }}">
                    <i class="pl-3 nav-icon fas fa-shopping-cart"></i>
                    <p class="pl-3">
                      Order Article
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('article/create') }}" class="nav-link {{ Request::is('article/create*') ? 'active open' : '' }}">
                    <i class="pl-3 nav-icon fas fa-plus"></i>
                    <p class="pl-3">
                      Create Article
                    </p>
                  </a>
                </li>
                @endrole
                @role('company admin|company user|system admin|system user|system editor')
                <li class="nav-item">
                  <a href="{{ route('article/orders') }}" class="nav-link {{ Request::is('article/orders*') ? 'active open' : '' }}">
                    <i class="pl-3 nav-icon fas fa-file-signature"></i>
                    <p class="pl-3">
                      Article Orders
                    </p>
                  </a>
                </li>
                @endrole
                @role('company admin|company user')
                <li class="nav-item">
                  <a href="{{ route('article/completed') }}" class="nav-link {{ Request::is('article/completed*') ? 'active open' : '' }}">
                    <i class="pl-3 nav-icon fas fa-file-signature"></i>
                    <p class="pl-3">
                      Completed Orders
                    </p>
                  </a>
                </li>
                @endrole
                <!-- @role('system admin|company user|system admin|system user')
                <li class="nav-item">
                  <a href="{{ route('article/requests') }}" class="nav-link {{ Request::is('article/requests*') ? 'active open' : '' }}">
                    <i class="pl-3 nav-icon fas fa-file-signature"></i>
                    <p class="pl-3">
                      Article Requests
                    </p>
                  </a>
                </li>
                @endrole -->
              </ul>
            @endrole
            <!-- @role('company admin|system admin')
            <li class="nav-item  {{ Request::is('Subscriptions*') ? 'menu-is-opening menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('Subscriptions*') ? 'active' : '' }} ">
                <i class="nav-icon fas fa-box "></i>
                <p>
                  Subscriptions
                  <i class="right fas fa-angle-left "></i>
                </p>
              </a>
              <ul class="nav nav-treeview {{ Request::is('Subscriptions*') ? 'd-block' : '' }}">
                <li class="nav-item">
                  <a href="{{ route('package/lists') }}" class="nav-link {{ Request::is('Subscriptions/lists*') ? 'active open' : '' }}">
                    <i class="pl-3 nav-icon fas fa-eye"></i>
                    <p class="pl-3">
                      View All Subscriptions
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('package/create') }}" class="nav-link {{ Request::is('package/create*') ? 'active open' : '' }}">
                    <i class="pl-3 nav-icon fas fa-plus"></i>
                    <p class="pl-3">
                      Create Package
                    </p>
                  </a>
                </li>
              </ul>
            @endrole -->
            @role('system admin|system editor|company admin')
            <li class="nav-item  {{ Request::is('package*') ? 'menu-is-opening menu-open' : '' }}">
              <a href="#" class="nav-link {{ Request::is('package*') ? 'active' : '' }} ">
                <i class="nav-icon fas fa-box "></i>
                <p>
                  Package
                  <i class="right fas fa-angle-left "></i>
                </p>
              </a>
              <ul class="nav nav-treeview {{ Request::is('package*') ? 'd-block' : '' }}">
                <li class="nav-item">
                  <a href="{{ route('package/lists') }}" class="nav-link {{ Request::is('package/lists*') ? 'active open' : '' }}">
                    <i class="pl-3 nav-icon fas fa-eye"></i>
                    <p class="pl-3">
                      View All Package
                    </p>
                  </a>
                </li>
                @role('system admin|system editor')
                <li class="nav-item">
                  <a href="{{ route('package/create') }}" class="nav-link {{ Request::is('package/create*') ? 'active open' : '' }}">
                    <i class="pl-3 nav-icon fas fa-plus"></i>
                    <p class="pl-3">
                      Create Package
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('package/requests') }}" class="nav-link {{ Request::is('package/requests*') ? 'active open' : '' }}">
                    <i class="pl-3 nav-icon fas fa-file-signature"></i>
                    <p class="pl-3">
                      Subscription Requests
                    </p>
                  </a>
                </li>
                @endrole
                @role('company admin')
                <li class="nav-item">
                  <a href="{{ route('package/my-subscriptions') }}" class="nav-link {{ Request::is('package/my-subscriptions*') ? 'active open' : '' }}">
                    <i class="pl-3 nav-icon fas fa-file-signature"></i>
                    <p class="pl-3 text-sm">
                      My Subscription Requests
                    </p>
                  </a>
                </li>
                @endrole
              </ul>
            @endrole
          </li>
          <li class="nav-item">
            <a href="{{route('invoice/lists')}}" class="nav-link {{ Request::is('invoice/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Invoices
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('view-profile')}}" class="nav-link {{ Request::is('view-profile*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-eye"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('change-password') }}" class="nav-link {{ Request::is('change-password*') ? 'active' : '' }}">
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
