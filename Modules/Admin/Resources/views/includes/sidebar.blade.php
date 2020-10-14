  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        @if(Request::is('bakpau982/home'))
          <li class="active">
            <a href="{{ route('admin.home') }}" class="active">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
        @else
          <li>
            <a href="{{ route('admin.home') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
        @endif
        <li class="header">Manage CMS</li>
        @if(Request::is('bakpau982/post/list') || Request::is('bakpau982/post/create') || Request::is('bakpau982/post/update/*') || Request::is('bakpau982/post/category') || Request::is('bakpau982/post/tag') || Request::is('bakpau982/post/gallery')) 
        <li class="active treeview"> 
          <a href="#">
            <i class="fa fa-list"></i> <span>Post</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(Request::is('bakpau982/post/list') || Request::is('bakpau982/post/create') || Request::is('bakpau982/post/update/*'))
              @if(in_array('read-post', $permissions_per_session))
              <li class="active"><a href="{{ route('admin.post_list') }}"><i class="fa fa-list"></i> Post</a></li>
              @endif
            @else
              @if(in_array('read-post', $permissions_per_session))
              <li><a href="{{ route('admin.post_list') }}"><i class="fa fa-list"></i> Post</a></li>
              @endif
            @endif
            @if(Request::is('bakpau982/post/category'))
            <li class="active"><a href="{{ route('admin.post_category') }}"><i class="fa fa-camera"></i> Category</a></li>
            @else
            <li><a href="{{ route('admin.post_category') }}"><i class="fa fa-camera"></i> Category</a></li>
            @endif
            @if(Request::is('bakpau982/post/tag'))
            <li class="active"><a href="{{ route('admin.post_tag') }}"><i class="fa fa-tags"></i> Tag</a></li>
            @else
            <li><a href="{{ route('admin.post_tag') }}"><i class="fa fa-tags"></i> Tag</a></li>
            @endif
            @if(Request::is('bakpau982/post/gallery'))
            <li class="active"><a href="{{ route('admin.post_gallery') }}"><i class="fa fa-image"></i> Gallery</a></li>
            @else
            <li><a href="{{ route('admin.post_gallery') }}"><i class="fa fa-image"></i> Gallery</a></li>
            @endif
          </ul>
        </li>
        @else
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i> <span>Post</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(in_array('read-post', $permissions_per_session))
            <li><a href="{{ route('admin.post_list') }}"><i class="fa fa-list"></i> Post</a></li>
            @endif
            <li><a href="{{ route('admin.post_category') }}"><i class="fa fa-camera"></i> Category</a></li>
            <li><a href="{{ route('admin.post_tag') }}"><i class="fa fa-tags"></i> Tag</a></li>
            <li><a href="{{ route('admin.post_gallery') }}"><i class="fa fa-image"></i> Gallery</a></li>
          </ul>
        </li>
        @endif
        <!-- @if(Request::is('admin/listing/list') || Request::is('admin/listing/area') || Request::is('admin/listing/cat') || Request::is('admin/listing/tag'))
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-list"></i> <span>Listing</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(Request::is('admin/listing/list'))
            <li class="active"><a href="{{ route('admin.listing_list') }}"><i class="fa fa-list"></i> Listing</a></li>
            @else
            <li><a href="{{ route('admin.listing_list') }}"><i class="fa fa-list"></i> Listing</a></li>
            @endif
            @if(Request::is('admin/listing/area'))
            <li class="active"><a href="{{ route('admin.listing_area') }}"><i class="fa fa-map"></i> Area</a></li>
            @else
            <li><a href="{{ route('admin.listing_area') }}"><i class="fa fa-map"></i> Area</a></li>
            @endif
            @if(Request::is('admin/listing/cat'))
            <li class="active"><a href="{{ route('admin.listing_category') }}"><i class="fa fa-camera"></i></i> Category</a></li>
            @else
            <li><a href="{{ route('admin.listing_category') }}"><i class="fa fa-camera"></i> Category</a></li>
            @endif
            @if(Request::is('admin/listing/tag'))
            <li class="active"><a href="{{ route('admin.listing_tag') }}"><i class="fa fa-tags"></i> Tag</a></li>
            @else
            <li><a href="{{ route('admin.listing_tag') }}"><i class="fa fa-tags"></i> Tag</a></li>
            @endif
          </ul>
        </li>
        @else
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i> <span>Listing</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.listing_list') }}"><i class="fa fa-list"></i> Listing</a></li>
            <li><a href="{{ route('admin.listing_area') }}"><i class="fa fa-map"></i> Area</a></li>
            <li><a href="{{ route('admin.listing_category') }}"><i class="fa fa-camera"></i> Category</a></li>
            <li><a href="{{ route('admin.listing_tag') }}"><i class="fa fa-tags"></i> Tag</a></li>
          </ul>
        </li>
        @endif -->
        <!-- @if(Request::is('admin/job') || Request::is('admin/job/company'))
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-list"></i> <span>Job</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(Request::is('admin/job'))
            <li class="active"><a href="#"><i class="fa fa-list"></i> Job</a></li>
            @else
            <li><a href="#"><i class="fa fa-list"></i> Job</a></li>
            @endif
            @if(Request::is('admin/job/company'))
            <li class="active"><a href="#"><i class="fa fa-map"></i> Company</a></li>
            @else
            <li><a href="#"><i class="fa fa-map"></i> Company</a></li>
            @endif
          </ul>
        </li>
        @else
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i> <span>Job</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-list"></i> Job</a></li>
            <li><a href="#"><i class="fa fa-map"></i> Company</a></li>
          </ul>
        </li>
        @endif -->
        @if(Request::is('bakpau982/banner/list') || Request::is('bakpau982/banner/advertorial') || Request::is('bakpau982/banner/interstitial'))
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-list"></i> <span>Banner</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(Request::is('bakpau982/banner/list'))
            <li class="active"><a href="{{ route('admin.banner_list') }}"><i class="fa fa-list"></i> Banner</a></li>
            @else
            <li><a href="{{ route('admin.banner_list') }}"><i class="fa fa-list"></i> Banner</a></li>
            @endif
            <!-- @if(Request::is('admin/banner/advertorial'))
            <li class="active"><a href="#"><i class="fa fa-map"></i> Advertorial</a></li>
            @else
            <li><a href="#"><i class="fa fa-map"></i> Advertorial</a></li>
            @endif
            @if(Request::is('admin/banner/interstitial'))
            <li class="active"><a href="#"><i class="fa fa-map"></i> Interstitial</a></li>
            @else
            <li><a href="#"><i class="fa fa-map"></i> Interstitial</a></li>
            @endif -->
          </ul>
        </li>
        @else
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i> <span>Banner</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.banner_list') }}"><i class="fa fa-list"></i> Banner</a></li>
            <!-- <li><a href="#"><i class="fa fa-map"></i> Advertorial</a></li>            
            <li><a href="#"><i class="fa fa-map"></i> Interstitial</a></li> -->
          </ul>
        </li>
        @endif
        @if(Request::is('bakpau982/clear-cache') || Request::is('bakpau982/setting/param'))
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-list"></i> <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(Request::is('bakpau982/setting/param'))
            <li class="active"><a href="{{ route('admin.param_list') }}"><i class="fa fa-list"></i> Site Params</a></li>
            @else
            <li><a href="{{ route('admin.param_list') }}"><i class="fa fa-list"></i> Site Params</a></li>
            @endif
            @if(Request::is('bakpau982/clear-cache'))
            <li class="active"><a href="{{ route('admin.clearCache') }}"><i class="fa fa-list"></i> Clear Cache All</a></li>
            @else
            <li><a href="{{ route('admin.clearCache') }}"><i class="fa fa-list"></i> Clear Cache All</a></li>
            @endif            
          </ul>
        </li>
        @else
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i> <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.param_list') }}"><i class="fa fa-list"></i> Site Params</a></li>
            <li><a href="{{ route('admin.clearCache') }}"><i class="fa fa-list"></i> Clear Cache All</a></li>
          </ul>
        </li>
        @endif
        @if(Session::get('kamibijak_admin') == 160 || Session::get('kamibijak_admin') == 4995)
          @if(Request::is('bakpau982/user/list') || Request::is('bakpau982/user/create') || Request::is('bakpau982/user/update/*') || Request::is('bakpau982/page/list'))
          <li class="active treeview">
            <a href="#">
              <i class="fa fa-list"></i> <span>More</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @if(Request::is('bakpau982/page/list'))
              <li class="active"><a href="{{ route('admin.page_list') }}"><i class="fa fa-list"></i> Page</a></li>
              @else
              <li><a href="{{ route('admin.page_list') }}"><i class="fa fa-list"></i> Page</a></li>
              @endif
              @if(Request::is('bakpau982/user/list') || Request::is('bakpau982/user/create') || Request::is('bakpau982/user/update/*'))
              <li class="active"><a href="{{ route('admin.user_list') }}"><i class="fa fa-list"></i> Admin User</a></li>
              @else
              <li><a href="{{ route('admin.user_list') }}"><i class="fa fa-list"></i> Admin User</a></li>
              @endif
            </ul>
          </li>
          @else
          <li class="treeview">
            <a href="#">
              <i class="fa fa-list"></i> <span>More</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">              
              <li><a href="{{ route('admin.page_list') }}"><i class="fa fa-list"></i> Page</a></li>
              <li><a href="{{ route('admin.user_list') }}"><i class="fa fa-list"></i> Admin User</a></li>
            </ul>
          </li>
          @endif
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  

<!-- <div class="left-sidebar-pro">
    <nav id="sidebar">
        <div class="sidebar-header">
            @if(!$current_admin['avatar'] == Null)
            <a href="#">
                <img src="{{url('assets/admin/img/message/1.jpg')}}" alt="" /> -->
                <!-- <img src="{{ env('URL_MEDIA').'/'.$current_admin['avatar'] }}" alt="" /> -->
            <!-- </a>
            @else
                <img src="{{url('assets/admin/img/message/1.jpg')}}" alt="" />
            @endif
            <h3>{{$current_admin['fullname']}}</h3>
            @if($current_admin['user_status'] == 1)
            <p>Banned</p>
            @elseif($current_admin['user_status'] == 2)
            <p>Unveried</p>
            @elseif($current_admin['user_status'] == 3)
            <p>Verified</p>
            @elseif($current_admin['user_status'] == 4)
            <p>Official</p>
            @endif
            <strong>AP+</strong> -->
        <!-- </div>
        <div class="left-custom-menu-adp-wrap">
            <ul class="nav navbar-nav left-sidebar-menu-pro">
                <li class="nav-item">
                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-home"></i> &nbsp;&nbsp; <span class="mini-dn">Home</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                    <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                        <a href="dashboard.html" class="dropdown-item">Dashboard</a>
                        <a href="analytics.html" class="dropdown-item">Analytics</a>
                    </div>
                </li>

                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;&nbsp; <span class="mini-dn">Post</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                    <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                        <a href="{{ route('admin.post_list')}}" class="dropdown-item">Post List</a>
                        <a href="{{ route('admin.post_category')}}" class="dropdown-item">Category</a>
                        <a href="{{ route('admin.post_tag')}}" class="dropdown-item">Tag</a>
                        <a href="#" class="dropdown-item">Selector</a>
                        <a href="#" class="dropdown-item">Clear Instan Content</a>
                        <a href="#" class="dropdown-item">Contibutor Wallet</a>
                    </div>
                </li>

                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-blind" aria-hidden="true"></i> &nbsp;&nbsp; <span class="mini-dn">Job</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                    <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                        <a href="#" class="dropdown-item">Job List</a>
                        <a href="#" class="dropdown-item">Company</a>
                    </div>
                </li>

                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-file-image-o" aria-hidden="true"></i> &nbsp;&nbsp; <span class="mini-dn">Banner</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                    <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                        <a href="#" class="dropdown-item">Banner List</a>
                        <a href="#" class="dropdown-item">Advertorial</a>
                        <a href="#" class="dropdown-item">Interstitial</a>
                    </div>
                </li>

                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-address-book" aria-hidden="true"></i> &nbsp;&nbsp; <span class="mini-dn">Stat</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                    <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                        <a href="#" class="dropdown-item">Site Rank</a>
                        <a href="#" class="dropdown-item">Realtime Static</a>
                        <a href="#" class="dropdown-item">Visitor Static</a>
                        <a href="#" class="dropdown-item">Email Subscriber</a>
                        <a href="#" class="dropdown-item">Apps Broadcast Text</a>
                    </div>
                </li>

                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-cog" aria-hidden="true"></i> &nbsp;&nbsp; <span class="mini-dn">Setting</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                    <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                        <a href="#" class="dropdown-item">Site Menus</a>
                        <a href="#" class="dropdown-item">Site Paramas</a>
                        <a href="#" class="dropdown-item">SlideShow</a>
                        <a href="#" class="dropdown-item">Url Redirection</a>
                        <a href="#" class="dropdown-item">Clear All Cache</a>
                        <a href="#" class="dropdown-item">Clear All Media Sizes</a>
                    </div>
                </li>

                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-wheelchair-alt" aria-hidden="true"></i> &nbsp;&nbsp; <span class="mini-dn">More</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                    <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                        <a href="#" class="dropdown-item">Microsite</a>
                        <a href="#" class="dropdown-item">Gallery</a>
                        <a href="#" class="dropdown-item">Playlist</a>
                        <a href="#" class="dropdown-item">Quote</a>
                        <a href="#" class="dropdown-item">Page</a>
                        <a href="{{ route('admin.user_list')}}" class="dropdown-item">Admin User</a>
                        <a href="#" class="dropdown-item">General User</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div> -->