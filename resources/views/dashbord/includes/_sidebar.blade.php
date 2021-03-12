  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('dashboard/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
     
        <li>
          <a href="{{route('dashbord.welcome')}}">
            <i class="fa fa-th"></i> <span>@lang('site.dashboard')</span>
          </a>
        </li>
          @if(auth()->user()->hasPermission('read_categories'))
          <li>
          <a href="{{route('dashbord.categories.index')}}">
            <i class="fa fa-list-alt" aria-hidden="true"> </i><span>@lang('site.categories')</span>
          </a>
        </li>
        @endif

           @if(auth()->user()->hasPermission('read_categories'))
          <li>
          <a href="{{route('dashbord.orders.index')}}">
            <i class="fa fa-list-alt" aria-hidden="true"> </i><span>@lang('site.orders')</span>
          </a>
        </li>
        @endif
        @if(auth()->user()->hasPermission('read_users'))
          <li>
          <a href="{{route('dashbord.user.index')}}">
            <i class="fa fa-user" aria-hidden="true"></i> <span>@lang('site.users')</span>
          </a>
        </li>
        @endif
          @if(auth()->user()->hasPermission('read_products'))
          <li>
          <a href="{{route('dashbord.products.index')}}">
            <i class="fa fa-product-hunt"></i> <span>@lang('site.products')</span>
          </a>
        </li>
        @endif
         @if(auth()->user()->hasPermission('read_clients'))
          <li>
          <a href="{{route('dashbord.clients.index')}}">
            <i class="fa fa-users" aria-hidden="true"></i> <span>@lang('site.clients')</span>
          </a>
        </li>
        @endif
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>