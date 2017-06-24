<style type="text/css">
    #image_view_update:hover{
       /* box-shadow: 0 0 5px #8E8E38; */
    }
</style>
<script type="text/javascript">

    $(function(){
        var imageBgCol = $('.user-header').css('background-color');
        $('#image_view_update').css('background-color', imageBgCol);
    });
    
</script>

<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">{{ Setting::get('app.short_name') }}</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{!! Setting::get('app.long_name') !!}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                @if (Auth::check())

                    @if ( Setting::get('app.context_help_area') && (isset($context_help_area)))
                        {!! $context_help_area   !!}
                    @endif

                    @if ( Setting::get('app.notification_area') )
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the messages -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <!-- User Image -->
                                                    <img src="{{ asset("/bower_components/admin-lte/dist/img/generic_user_160x160.jpg") }}" class="img-circle" alt="User Image"/>
                                                </div>
                                                <!-- Message title and timestamp -->
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <!-- The message -->
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li><!-- end message -->
                                    </ul><!-- /.menu -->
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li><!-- /.messages-menu -->
                        <!-- Notifications Menu -->
                        <li class="dropdown notifications-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- Inner Menu: contains the notifications -->
                                    <ul class="menu">
                                        <li><!-- start notification -->
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li><!-- end notification -->
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks Menu -->
                        <li class="dropdown tasks-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-folder-open-o"></i><!-- @cpnwaugha:c-e -->
                                <span id="folder_notif" class="label label-danger"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- Inner menu: contains the tasks -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <!-- Task title and progress text -->
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <!-- The progress bar -->
                                                <div class="progress xs">
                                                    <!-- Change the css width attribute to simulate progress -->
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="position: relative; padding-left: 50px;">
                            <!-- The user image in the navbar-->
                            <!--@cpnwaugha: c-e: adding new user image from picture upload-->
                            {{--<img src="{{ Gravatar::get(Auth::user()->email , 'tiny') }}" class="user-image" alt="User Image"/>--}}

                             <img src="img/profile_picture/photo/{{ Auth::user()->avatar }}" class="user-image" style="width: 32px; height: 32px; position: absolute; top: 10px; left: 10px;border-radius: 50%;" alt="User Image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->username }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <a id="image_view_update" class="users-list-name" href="{{route('user.profile.photo')}}"><img src="img/profile_picture/photo/{{ Auth::user()->avatar }}" class="img-circle" style="width: 130px; height: 100px; border-radius: 50%; margin-right: 25px;" alt="User Image"/>
                                </a>

                                {{-- @cpnwaugha: c-e: removed <img src="{{ Gravatar::get(Auth::user()->email , 'medium') }}" class="img-circle" alt="User Image" /> --}}

                                {{--<a class="users-list-name" href="">{!! link_to_route('admin.users.show', $user->full_name, [$user->id], []) !!}</a>--}}
                                
                                <p>
                                    {{ Auth::user()->full_name }}
                                    <small>Member since {{ Auth::user()->created_at->format("F, Y") }}</small>
                                </p>
                            </li>

                            @if ( Setting::get('app.extended_user_menu') )
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                            @endif

                            <!-- Menu Footer-->
                            <!-- @cpnwaugha changed button default->color, and flat-raised-->
                            <li class="user-footer">

                                @if ( Setting::get('app.user_profile_link') )
                                    <div class="pull-left">
                                        {!! link_to_route('user.profile', 'Profile', [], ['class' => "btn btn-info btn-raised"]) !!}
                                    </div>
                                @endif
                                <!-- @cpnwaugha: c-e work on this for profile photo updata -->
                                

                                <div class="pull-right">
                                    {!! link_to_route('logout', 'Sign out', [], ['class' => "btn btn-danger btn-raised"]) !!}
                                </div>
                            </li>
                        </ul>
                    </li>

                    @if ( Setting::get('app.right_sidebar') )
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    @endif
                @else
                    <li>{!! link_to_route('login', 'Sign in') !!}</li>
                    @if (Setting::get('app.allow_registration'))
                        <li>{!! link_to_route('register', 'Register') !!}</li>
                    @endif
                @endif
            </ul>
        </div>
    </nav>
</header>
