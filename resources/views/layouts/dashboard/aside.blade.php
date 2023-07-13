<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"
  integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: 0.8" />
    <span class="brand-text font-weight-light">{{Auth::user()->name}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @if (Auth::user()->image)
        <img src="{{ url('storage/uploads/images/' . Auth::user()->image) }}" data-toggle="lightbox"
          class="img-circle elevation-2" alt="User Image" />
        @else
        <img src="{{ URL('https://avatars.githubusercontent.com/u/37823431?v=4') }}" data-toggle="lightbox"
          class="img-circle elevation-2" alt="Default User Image" />
        @endif
      </div>

      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
        {{-- --}}
        <li class="nav-header">Content Management</li>
        <li class="nav-item">
          <a href="{{route('cities.index')}}" class="nav-link">
            {{-- <i class="nav-icon fas fa-th"></i> --}}
            <i class="nav-icon fa fa-city"></i>
            <p>
              Cities
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('workspace.index')}}" class="nav-link">
            <i class="nav-icon fa fa-city"></i>
            <p>
              WorkSpace Categories
            </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{route('faq.index')}}" class="nav-link">
            <i class="nav-icon fa fa-city"></i>
            <p>
              Faq
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('contact-request.index')}}" class="nav-link">
            <i class="nav-icon fa fa-city"></i>
            <p>
              Contact Request
            </p>
          </a>
        </li>

        <li class="nav-header">Hubs Management</li>
        {{-- menu-open --}}
        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-building"></i>
            <p>
              Hubs
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('hubs.index')}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Hubs Page</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('working_times.index')}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Working Time</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('internet_accounts.index')}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Internet Account</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">Rooms Management</li>
        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-house-user"></i>
            <p>
              Rooms
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('rooms.index')}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Rooms Page</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">Desk Management</li>
        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Desks
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('desks.index')}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Desks Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('desk_types.index')}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Desk Type Page</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">Component Management</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-layer-group"></i>
            <p>
              Components
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('components.index') }}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Components Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('component_types.index') }}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Components Type Page</p>
              </a>
            </li>

          </ul>
        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-layer-group"></i>
            <p>
              Item Components
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @foreach(['room', 'desk', 'meeting room'] as $type)
            <li class="nav-item">
              <a href="{{ route('item_components.index', ['type_name' => $type]) }}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>{{ ucfirst($type) }} Components</p>
              </a>
            </li>
            @endforeach
          </ul>
        </li>
        </li>
        <li class="nav-header">Meeting Room Management</li>
        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-layer-group"></i>
            <p>
              Meeting Room
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('meeting_rooms.index')}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Meeting Rooms Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('meeting_room_orders.index')}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Meeting Rooms Orders</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('meetings.index')}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Meetings</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">Service Management</li>
        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-layer-group"></i>
            <p>
              Services
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('services.index')}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Services Page</p>
              </a>
              <a href="{{route('item_services.index')}}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Item Service
                </p>
              </a>
              <a href="{{route('rent_services.index')}}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Rent Services
                </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">Rent Management</li>
        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-layer-group"></i>
            <p>
              Rent
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @foreach(['room', 'desk', 'meeting_rooms'] as $type)
            <li class="nav-item">
              <a href="{{ route('rent.index', ['type_name' => $type]) }}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>{{ ucfirst($type) }} Rent</p>
              </a>
            </li>
            @endforeach
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('rent_types.index')}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Rent Type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('rent.create')}}" class="nav-link">
                <i class="fa-solid fa-plus"></i>
                <p>Create</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">Orders Management</li>
        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-layer-group"></i>
            <p>
              Orders
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{route('orders.index')}}" class="nav-link">
                <i class="fa-solid fa-list"></i>
                <p>
                  Orders
                </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">Order items Management</li>
        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-layer-group"></i>
            <p>
              Order items
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @foreach(['room', 'desk'] as $type)
            <li class="nav-item">
              <a href="{{route('order_items.index',['type_name' => $type])}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>{{ ucfirst($type) }} Order Items</p>
              </a>
            </li>
            @endforeach
            <li class="nav-item">
              <a href="{{route('order_items.create')}}" class="nav-link">
                <i class="fa-solid fa-plus"></i>
                <p>Create</p>
              </a>
            </li>
          </ul>
    
        </li>

        <li class="nav-header">Images Management</li>
        <li class="nav-item">
          <a href="{{route('gallery.index')}}" class="nav-link">
            <i class="nav-icon fa fa-city"></i>
            <p>
              Gallery
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('image.index')}}" class="nav-link">
            <i class="nav-icon fa fa-city"></i>
            <p>
              Image
            </p>
          </a>
        </li>

        <li class="nav-header">User Management</li>
        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-layer-group"></i>
            <p>
              User Management
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admins.index')}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>Admin</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('user.index')}}" class="nav-link">
                <i class="fa fa-list nav-icon"></i>
                <p>User</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">Settings</li>
        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-layer-group"></i>
            <p>
              Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
          <a href="{{route('cms.logout')}}" class="nav-link">
            {{-- <i class="nav-icon fas fa-th"></i> --}}
            <i class="fa-thin fa-arrow-up-left-from-circle"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('cms.edit-password')}}" class="nav-link">
            {{-- <i class="nav-icon fas fa-th"></i> --}}
            <i class="fa-thin fa-arrow-up-left-from-circle"></i>
            <p>
              Change Password
            </p>
          </a>
        </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<script src="{{ asset('assets/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"
  integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>