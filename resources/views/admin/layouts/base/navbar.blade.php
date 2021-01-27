<!-- navbar-->
<header class="header" xmlns="http://www.w3.org/1999/html">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a>
                    <a href="{{route('admin.dashboard')}}" class="navbar-brand">
                        <div class="d-none d-md-inline-block"><span class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"logo-name-arabic" : "logo-name"}}">{{__('Sihr')}} {{__('Al Sharq')}}</span></div></a></div>
                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <!-- Notifications dropdown-->
                    <li class="nav-item dropdown" > <a id="get-notifications" data-user="{{auth()->user()->id}}" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell fa-lg"></i><span class="badge badge-warning" id="notifications-count" style="display: none;">{{auth()->user()->notificationsCount()}}</span></a>
                        <ul aria-labelledby="notifications" class="dropdown-menu notification-dropdown" style="margin-left:-.5rem;text-align: {{isArabic()?"right":""}};">
                            <div class="notification-list" dir="{{isArabic()?"rtl":""}}">
                                <!-- Notifications List Added by Jquery -->
                            </div>
                                <hr>
                            <li><a rel="nofollow" href="{{route('admin.notifications-all')}}" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>{{__('view all notifications')}}                                            </strong></a></li>
                        </ul>
                    </li>
                    <!-- Languages dropdown    -->
                    <li class="nav-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle">
                            <img src="/dashboard/img/flags/two/{{\Illuminate\Support\Facades\App::currentLocale()}}.png" alt="{{\Illuminate\Support\Facades\App::currentLocale()== 'ar' ? 'العربية' : 'English'}}">
                            <span class="d-none d-sm-inline-block">{{\Illuminate\Support\Facades\App::currentLocale()== 'ar' ? 'العربية' : 'English'}}</span></a>
                        <ul aria-labelledby="languages" id="langdropdown" class="dropdown-menu" style="min-width: 6.5rem;padding: .2rem">
                            <li><a rel="nofollow" href="{{route('change.language',\Illuminate\Support\Facades\App::currentLocale()== 'en' ? 'ar' : 'en')}}" class="dropdown-item">
                                    <img src="/dashboard/img/flags/two/{{\Illuminate\Support\Facades\App::currentLocale()== 'en' ? 'ar' : 'en'}}.png" alt="{{\Illuminate\Support\Facades\App::currentLocale()== 'en' ? 'العربية' : 'English'}}" class="mr-2">
                                    <span>{{\Illuminate\Support\Facades\App::currentLocale()== 'en' ? 'العربية' : 'English'}}</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- Log out-->
                    <li class="nav-item">
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <span class="nav-link">
                                <button class="text-white mt-2 btn btn-outline-dark rounded d-none d-sm-inline-block">{{__('Logout')}}
                                <i class="fa fa-sign-out"></i>
                                </button>

                            </span>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>