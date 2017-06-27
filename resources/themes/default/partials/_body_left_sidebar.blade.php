<!-- Left side column. contains the logo and sidebar -->

<style type="text/css">
    .main-sidebar{
        position: fixed !important;
    }
</style>
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            @if (Auth::check())
                <div class="pull-left image">
                    {{-- <img src="{{ Gravatar::get(Auth::user()->email , 'small') }}" class="img-circle" alt="User Image" /> --}}
                    <img src="{{ asset('/img/profile_picture/photo/'.Auth::user()->avatar) }}" class="user-image" style="width: 62px; height: 52px; top: 10px; left: 10px; border-radius: 50%;" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->full_name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            @endif
        </div>

        @if ( Setting::get('app.search_box') )
            <!-- search form (Optional) -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
                </div>
            </form>
            <!-- /.search form -->
        @endif

        {!! MenuBuilder::renderMenu('home')  !!}

        {!! MenuBuilder::renderMenu('admin', true)  !!}

        <a href="compose" style="margin-left:20px"><i class="fa fa-envelope"></i>  Memo <span class="label label-primary pull-right">{{-- Memo notification to come here..--}}</span></a>

    </section>
    <!-- /.sidebar -->
</aside>
