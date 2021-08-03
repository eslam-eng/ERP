<header class="main-header">
    <!-- Logo -->
    <a href="{{route('home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>C</b>pnle</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{trans('trans.Dashbord')}}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">2</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">{{trans('trans.lan')}}</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="{{route('lang','ar')}}">
                                        <p>
                                            عربي  <i class="fa fa-language"></i>
                                        </p>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="{{route('lang','en')}}">
                                        <p>
                                            English
                                            <i class="fa fa-language"></i>
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('upload/user.png')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{auth()->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('upload/user.png')}}" class="img-circle" alt="User Image">
                            <p>
                                {{auth()->user()->name}}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="{{route('logout')}}" class="btn btn-default btn-flat">{{trans('trans.logout')}}</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
