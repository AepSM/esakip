<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">{{ Auth::user()->data_opd->nama }}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (Auth::user()->roles == 'admin')
                            <img src="{{ asset('adminlte/dist/img/profile/profile.png') }}" class="user-image" alt="User Image">
                        @else
                            @if (Auth::user()->avatar == null)
                                <img src="{{ asset('adminlte/dist/img/profile/profile.png') }}" class="user-image" alt="User Image">
                            @else
                                <img src="{{ asset('adminlte/dist/img/profile/' . Auth::user()->avatar) }}" class="user-image" alt="User Image">
                            @endif
                        @endif 
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            @if (Auth::user()->roles == 'admin')
                                <img src="{{ asset('adminlte/dist/img/profile/profile.png') }}" class="img-circle" alt="User Image">
                            @else
                                @if (Auth::user()->avatar == null)
                                    <img src="{{ asset('adminlte/dist/img/profile/profile.png') }}"class="img-circle" alt="User Image">
                                @else
                                    <img src="{{ asset('adminlte/dist/img/profile/' . Auth::user()->avatar) }}" class="img-circle" alt="User Image">
                                @endif
                            @endif   

                            <p>
                            {{ Auth::user()->name }}
                            <small>{{ Auth::user()->email }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('profile.edit', ['id' => Auth::user()->id]) }}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}"  class="btn btn-default btn-flat"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>