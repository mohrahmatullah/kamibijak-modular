<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo" style="background-color: #222d32;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{ default_img_user() }}" class="user-image" alt="User Image"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{ default_logo_kamibijak() }}" class="user-image" alt="User Image"></span>

    </a>
    <!-- style="background-color: #ecf0f5;" -->
    <!-- <a target="_blank" title="kamibijak" href="{{ url('/') }}" class="logo"> --><!-- <i class="fa fa-shopping-cart" aria-hidden="true"></i> {!! trans('admin.view_online_store') !!} -->
      <!-- <img class="logo-desktop-home" src="https://i2.wp.com/www.kamibijak.com/wp-content/uploads/2018/08/cropped-logo-kamibijak-270x71-10-1.png?zoom=1.25&fit=270%2C71&ssl=1" title="kamibijak" alt="kamibijak" style="width: 68%;height: auto;margin-bottom: 0rem;margin-top: -1rem; margin-left: 0rem;" />

    </a> -->
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: #222d32;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if(!$current_admin['avatar'] == Null)
              <img src="{{ default_img_user() }}" class="user-image" alt="User Image">
              @else
              <img src="{{ default_img_user() }}" class="user-image" alt="User Image">
              @endif
              <span class="hidden-xs">{{$current_admin['fullname']}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="background-color: #222d32;">
                @if(!$current_admin['avatar'] == Null)
                <img src="{{ default_img_user() }}" class="img-circle" alt="User Image">
                @else
                <img src="{{ default_img_user() }}" class="img-circle" alt="User Image">
                @endif

                <p>
                  {{$current_admin['fullname']}}
                  @if($current_admin['user_status'] == 1)
                  <small>Banned</small>
                  @elseif($current_admin['user_status'] == 2)
                  <small>Unveried</small>
                  @elseif($current_admin['user_status'] == 3)
                  <small>Verified</small>
                  @elseif($current_admin['user_status'] == 4)
                  <small>Official</small>
                  @endif
                </p>
              </li> 
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
</header>

<!-- <div class="header-top-area">
<div class="fixed-header-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12">
                <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="admin-logo logo-wrap-pro">
                    <a href="#"><img src="{{url('assets/admin/img/logo/log.png')}}" alt="" />
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-1 col-sm-1 col-xs-12">

            </div>
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                <div class="header-right-info">
                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                        
                        <li class="nav-item">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                <span class="admin-name">{{$current_admin['fullname']}}</span>
                                <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
                            </a>
                            <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX">
                                <li><a href="#"><span class="adminpro-icon adminpro-home-admin author-log-ic"></span>My Account</a>
                                </li>
                                <li><a href="#"><span class="adminpro-icon adminpro-user-rounded author-log-ic"></span>My Profile</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">   <span class="adminpro-icon adminpro-locked author-log-ic"></span>Log Out
                                    </a>
                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div> -->