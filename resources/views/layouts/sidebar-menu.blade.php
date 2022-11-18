<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      {{-- <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt white"></i>
          <p>
            Dashboard
          </p>
        </router-link>
      </li> --}}
      <li class="nav-item">
        <router-link to="/orders" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart white"></i>
            <p>
                Orders
            </p>
        </router-link>
    </li>

      @can('isAdmin')
        <li class="nav-item">
          <router-link to="/users" class="nav-link">
            <i class="fa fa-users nav-icon white"></i>
            <p>Users</p>
          </router-link>
        </li>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog white"></i>
          <p>
            Settings
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          <li class="nav-item">
            <router-link to="/prices" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign white"></i>
              <p>
                Pricing
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/services" class="nav-link">
              <i class="nav-icon fas fa-file-alt white"></i>
              <p>
                Services
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/faq" class="nav-link">
              <i class="nav-icon fas fa-question-circle white"></i>
              <p>
                FAQ
              </p>
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/testimonial" class="nav-link">
                <i class="nav-icon fas fa-star white"></i>
                <p>
                    Testimonial
                </p>
            </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/static-pages" class="nav-link">
              <i class="nav-icon fas fa-paste white"></i>
              <p>
                  Static Pages
              </p>
          </router-link>
      </li>

             <li class="nav-item">
              <router-link to="/posts" class="nav-link">
                  <i class="nav-icon fa fa-blog white"></i>
                  <p>
                      Blog
                  </p>
              </router-link>
            </li>
        </ul>
      </li>

      @endcan



      <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-power-off red"></i>
          <p>
            {{ __('Logout') }}
          </p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </nav>
