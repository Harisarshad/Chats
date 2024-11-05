<div class="side-menu flex-lg-column mr-lg-1">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{url('/')}}" class="logo logo-dark">
            <span class="logo-sm">

                <img src="{{ asset('img/login/Logos-04.png') }}" alt="" height="30">

            </span>
        </a>

        {{-- <a href="{{url('/')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo.svg')}}" alt="" height="30">
            </span>
        </a> --}}
    </div>
    <!-- end navbar-brand-box -->

    <!-- Start side-menu nav -->
    <div class="flex-lg-column my-auto">
        <ul class="nav nav-pills side-menu-nav justify-content-center" role="tablist">
            <li class="nav-item" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="{{ __("Profile") }}">
                <a class="nav-link" id="pills-user-tab" data-toggle="pill" href="#pills-user" role="tab">
                    <i class="ri-user-2-line"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="{{ __("Chats") }}">
                <a class="nav-link active" id="pills-chat-tab" data-toggle="pill" href="#pills-chat" role="tab">
                    <i class="ri-message-3-line"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="{{ __("Groups") }}">
                <a class="nav-link" id="pills-groups-tab" data-toggle="pill" href="#pills-groups" role="tab">
                    <i class="ri-group-line"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="{{ __("Contacts") }}">
                <a class="nav-link" id="pills-contacts-tab" data-toggle="pill" href="#pills-contacts" role="tab">
                    <i class="ri-contacts-line"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="{{ __("Settings") }}">
                <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#pills-setting" role="tab">
                    <i class="ri-settings-2-line"></i>
                </a>
            </li>
            <li class="nav-item dropdown profile-user-dropdown d-inline-block d-lg-none">
                <a class="nav-link dropdown-toggle" href="javascript: void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset(Auth::user()->avatar)}}" alt="" class="profile-user rounded-circle">
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" id="profile-tab">{{ __("Profile") }} <i class="ri-profile-line float-right text-muted"></i></a>
                    <a class="dropdown-item" href="#" id="setting-tab">{{ __("Setting") }} <i class="ri-settings-3-line float-right text-muted"></i></a>
                    <div class="dropdown-divider"></div> 
                    <a class="dropdown-item" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('side-logout-form').submit();">{{ __("Log out") }} <i class="ri-logout-circle-r-line float-right text-muted"></i></a>
                    <form id="side-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <!-- end side-menu nav -->

    <div class="flex-lg-column d-none d-lg-block">
        <ul class="nav side-menu-nav justify-content-center">
            {{-- <li class="nav-item">
                <a class="nav-link" id="light-dark" href="#" data-toggle="tooltip" data-trigger="hover" data-placement="right" title="{{ __("Dark / Light Mode") }}">
                    <i class="ri-sun-line theme-mode-icon"></i>
                </a>
            </li> --}}

            <li class="nav-item btn-group dropup profile-user-dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{(!empty(Auth::user()->avatar))?  \Modules\Chats\Src\Models\Group::get_file(Auth::user()->avatar): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="" class="profile-user rounded-circle imgavatar">
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" id="profile-tab">{{ __("Profile") }} <i class="ri-profile-line float-right text-muted"></i></a>
                    <a class="dropdown-item" href="#" id="setting-tab">{{ __("Setting") }} <i class="ri-settings-3-line float-right text-muted"></i></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __("Log out") }} <i class="ri-logout-circle-r-line float-right text-muted"></i></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <!-- Side menu user -->
</div>
