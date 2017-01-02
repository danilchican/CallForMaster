<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(empty($image = Auth::user()->company->logo_url))
                    <img src="/backend/themes/adminpanel/images/no_avatar.png" class="img-circle" alt="User Image">
                @else
                    <img src="/uploads/images/{{$image}}" class="img-circle" alt="User Image">
                @endif
            </div>
            <div class="pull-left info">
                @if(is_null($name = Auth::user()->name))
                    <p>No Name</p>
                @else
                    <p>{{ $name }}</p>
                @endif
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li @if(Request::is('admin')) class="active" @endif>
                <a href="{{ route('adminpanel_index') }}"><i class="fa fa-dashboard"></i> <span>Admin-panel</span></a>
            </li>
            <li @if(Request::is('admin/companies')) class="active" @endif>
                <a href="{{ route('companies_index') }}"><i class="fa fa-user"></i><span>Companies</span>
                    <!-- If having a new companies today that it will be display as 'new' -->
                    <small class="label pull-right bg-red" data-toggle="tooltip" data-original-title="Today">new</small>
                </a>
            </li>

            <li @if(Request::is('adminpanel/orders')) class="active" @endif>
                <a href="/adminpanel/orders">
                    <i class="fa fa-share"></i> <span>Orders</span>
                    <!-- If having a new orders today that it will be display as 'new' -->
                    <small class="label pull-right bg-green"
                           data-toggle="tooltip" data-original-title="Today">new</small>
                </a>
            </li>
            <li>
                <a href="/adminpanel/reviews">
                    <i class="fa fa-comments"></i> <span>Reviews</span>
                    <!-- If having a new reviews today that it will be display as 'new' -->
                    <small class="label pull-right bg-yellow"
                           data-toggle="tooltip" data-original-title="Today">new</small>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span>Tariffs</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.tariffs.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
                    <li><a href="{{ route('admin.tariffs.additional') }}"><i class="fa fa-circle-o"></i> Services</a></li>
                </ul>
            </li>
            <li>
                <a href="/adminpanel/news"><i class="fa fa-file-text-o"></i> <span>News</span></a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}"><i class="fa fa-list-ul"></i> <span>Categories</span></a>
            </li>
            <li>
                <a href="{{ route('admin.specialization.index') }}"><i class="fa fa-list-ul"></i> <span>Specializations</span></a>
            </li>
            <li>
                <a href="/adminpanel/menus"><i class="fa fa-th"></i> <span>Menus</span></a>
            </li>
            <li>
                <a href="/adminpanel/galleries"><i class="fa fa-picture-o"></i> <span>Galleries</span></a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>