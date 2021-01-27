<!-- Side Navbar -->
<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
            <!-- User Info-->
            <div class="sidenav-header-inner text-center">
                <h2 class="h5">{{auth()->user()->username}}</h2><span>System Admin</span>
            </div>
            <!-- Small Brand information, appears on minimized sidebar-->
            <div class="sidenav-header-logo"><a href="/index.html" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <h5 class="sidenav-heading">Main</h5>
            <ul id="side-main-menu" class="side-menu list-unstyled">
                @can('isSuperAdmin')
                <li><a href="#adminsdropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-user"></i>{{__('Admins')}} </a>
                    <ul id="adminsdropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="{{route('admin.admins.create')}}">{{__('Add Admin')}}</a></li>
                        <li><a href="{{route('admin.admins.index')}}">{{__('Show Admins')}}</a></li>
                    </ul>
                </li>
                @endcan
                <li><a href="#usersdropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-user"></i>{{__('Users')}} </a>
                    <ul id="usersdropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="{{route('admin.users.create')}}">{{__('Add User')}}</a></li>
                        <li><a href="{{route('admin.users.index')}}">{{__('Show Users')}}</a></li>
                    </ul>
                </li>
                <li>
                    <a id="questionnaire_word" href="{{route('admin.questionnaires.index')}}"> <i class="icon-padnote"></i>{{__('Questionnaires')}} </a>
                </li>
                <li><a href="#projectsdropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-website"></i>{{__('Projects')}}</a>
                    <ul id="projectsdropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="{{route('admin.projects.create')}}">{{__('Create Project')}}</a></li>
                        <li><a href="{{route('admin.projects.index')}}">{{__('Show Projects')}}</a></li>
                    </ul>
                </li>
                <li><a href="#threedmodelsdropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-website"></i>{{__('3D Models')}}</a>
                    <ul id="threedmodelsdropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="{{route('model.create')}}">{{__('Add 3D Model')}}</a></li>
                        <li><a href="{{route('model.index')}}">{{__('Show 3D Models')}}</a></li>
                    </ul>
                </li>
                <li><a href="#designsdropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-website"></i>{{__('Designs')}}</a>
                    <ul id="designsdropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="{{route('designers.create')}}">{{__('Add Design')}}</a></li>
                        <li><a href="{{route('designers.index')}}">{{__('Show Designs')}}</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('unisharp.lfm.show')}}" target="_blank"> <i class="fa fa-folder"></i>{{__('Admin Area')}}</a>
                </li>
                <li><a href="#settingsdropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-bars"></i>{{__('Settings')}}</a>
                    <ul id="settingsdropdownDropdown" class="collapse list-unstyled ">
                        <li>
                            <a href="{{route('contacts.index')}}"> <i class="fa fa-facebook"></i>{{__('Social Media')}} </a>
                        </li>
                        <li>

                            <a href="{{route('teams.index')}}"><i class="fa fa-group"></i>{{__('Manage Team')}}</a>
                            <a href="{{route('teams.create')}}"><i class="fa fa-user"></i>{{__('Add Employ TO Team')}}</a>
                        </li>
                    </ul>
                </li>
                    <li> <a> <form action="{{route('logout')}}" method="POST"> @csrf <i class="fa fa-sign-out mr-0"></i><button class="btn text-white">{{__('Logout')}}</button></form> </a></li>

            </ul>
        </div>
    </div>
</nav>