@extends('admin.layouts.master')

@section('content')
    <main role="main">

{{--        <!-- Main jumbotron for a primary marketing message or call to action -->--}}
{{--        <div class="text-white" style="background-image: url('bggg.jpg'); height: 35%; padding: 2rem;">--}}
{{--            <div class="container" >--}}
{{--                <h1 class="display-4">Sihr Al-Sharq<span class="h1">&nbsp;Admin Dashboard </span></h1>--}}
{{--                <p><a class="btn btn-dark rounded btn-lg" href="{{route('users.home')}}" role="button">Go To Main Website</a></p>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="container mt-4">--}}
{{--            <!-- Example row of columns -->--}}
{{--            <div class="row flex d-inline-flex justify-content-center">--}}

{{--                <div class="text-center col-md-3 border border-info rounded mr-4 ml-4 mb-3">--}}
{{--                    <span class="text-gray fa fa-user fa-5x mt-2 mb-2"></span>--}}
{{--                    <h2 class="text-gray">Users</h2>--}}
{{--                    <p>Manage our Users with a full control on Creating, Updating and Deleting users</p>--}}
{{--                    <p><a class="btn btn-primary rounded" href="{{route('admin.users.index')}}" role="button">View Users</a></p>--}}
{{--                </div>--}}

{{--                <div class="text-center col-md-3 border border-info rounded mr-4 ml-4 mb-3">--}}
{{--                    <span class="text-gray fa fa-wpforms fa-5x mt-2 mb-2"></span>--}}
{{--                    <h2 class="text-gray">Questionnaires</h2>--}}
{{--                    <p>Manage our Users with a full control on Creating, Updating and Deleting users</p>--}}
{{--                    <p><a class="btn btn-primary rounded" href="{{route('admin.questionnaires.index')}}" role="button">View Questionnaires</a></p>--}}
{{--                </div>--}}
{{--                <div class="text-center col-md-3 border border-info rounded mr-4 ml-4 mb-3">--}}
{{--                    <span class="text-gray fa fa-building-o fa-5x mt-2 mb-2"></span>--}}
{{--                    <h2 class="text-gray">Projects</h2>--}}
{{--                    <p>Manage our Users with a full control on Creating, Updating and Deleting users</p>--}}
{{--                    <p><a class="btn btn-primary rounded" href="#" role="button">View Projects</a></p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <hr>--}}

{{--        </div> <!-- /container -->--}}




        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="text-white" style="background-image: url('bggg.jpg'); height: 42%; padding: 2rem;">
            <div class="container" >
                <h1 class="display-4">Sihr AlSharq<span class="h1">&nbsp;Admin Dashboard </span></h1>
                <p><a class="btn btn-dark rounded btn-lg" href="{{route('users.home')}}" role="button">Go To Main Website</a></p>
            </div>
        </div>
<!-- Counts Section -->
    <section class="dashboard-counts section-padding">
        <div class="container-fluid">
            <div class="row">
                <!-- Count item widget-->
                <div class="col-xl-3 col-md-4 col-6">
                    <div class="wrapper count-title d-flex">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="name"><strong class="text-uppercase">New Users</strong><span>Last 7 days</span>
                            <div class="count-number">25</div>
                        </div>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-xl-3 col-md-4 col-6">
                    <div class="wrapper count-title d-flex">
                        <div class="icon"><i class="icon-padnote"></i></div>
                        <div class="name"><strong class="text-uppercase">Submitted Forms</strong><span>Last 5 days</span>
                            <div class="count-number">40</div>
                        </div>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-xl-3 col-md-4 col-6">
                    <div class="wrapper count-title d-flex">
                        <div class="icon"><i class="icon-check"></i></div>
                        <div class="name"><strong class="text-uppercase">Current Projects</strong><span>Last 2 months</span>
                            <div class="count-number">61</div>
                        </div>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-xl-3 col-md-4 col-6">
                    <div class="wrapper count-title d-flex">
                        <div class="icon"><i class="icon-list"></i></div>
                        <div class="name"><strong class="text-uppercase">Open Cases</strong><span>Last 3 months</span>
                            <div class="count-number">92</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <div class="flex justify-content-between">
            <div>
                <section class="mt-30px mb-30px">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <!-- Recent Updates Widget          -->
                                <div id="new-updates" class="card updates recent-updated">
                                    <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
                                        <h2 class="h5 display"><a data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box">News Project Updates</a></h2><a data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box"></a>
                                    </div>
                                    <div id="updates-box" role="tabpanel" class="collapse show">
                                        <ul class="news list-unstyled">
                                            <!-- Item-->
                                            <li class="d-flex justify-content-between">
                                                <div class="left-col d-flex">
                                                    <div class="icon"><i class="icon-rss-feed"></i></div>
                                                    <div class="title"><strong>Lorem ipsum dolor sit amet.</strong>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                                                    </div>
                                                </div>
                                                <div class="right-col text-right">
                                                    <div class="update-date">24<span class="month">Jan</span></div>
                                                </div>
                                            </li>
                                            <!-- Item-->
                                            <li class="d-flex justify-content-between">
                                                <div class="left-col d-flex">
                                                    <div class="icon"><i class="icon-rss-feed"></i></div>
                                                    <div class="title"><strong>Lorem ipsum dolor sit amet.</strong>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                                                    </div>
                                                </div>
                                                <div class="right-col text-right">
                                                    <div class="update-date">24<span class="month">Jan</span></div>
                                                </div>
                                            </li>
                                            <!-- Item-->
                                            <li class="d-flex justify-content-between">
                                                <div class="left-col d-flex">
                                                    <div class="icon"><i class="icon-rss-feed"></i></div>
                                                    <div class="title"><strong>Lorem ipsum dolor sit amet.</strong>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                                                    </div>
                                                </div>
                                                <div class="right-col text-right">
                                                    <div class="update-date">24<span class="month">Jan</span></div>
                                                </div>
                                            </li>
                                            <!-- Item-->
                                            <li class="d-flex justify-content-between">
                                                <div class="left-col d-flex">
                                                    <div class="icon"><i class="icon-rss-feed"></i></div>
                                                    <div class="title"><strong>Lorem ipsum dolor sit amet.</strong>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                                                    </div>
                                                </div>
                                                <div class="right-col text-right">
                                                    <div class="update-date">24<span class="month">Jan</span></div>
                                                </div>
                                            </li>
                                            <!-- Item-->
                                            <li class="d-flex justify-content-between">
                                                <div class="left-col d-flex">
                                                    <div class="icon"><i class="icon-rss-feed"></i></div>
                                                    <div class="title"><strong>Lorem ipsum dolor sit amet.</strong>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                                                    </div>
                                                </div>
                                                <div class="right-col text-right">
                                                    <div class="update-date">24<span class="month">Jan</span></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                            <div class="row flex d-inline-flex justify-content-center mx-2">

                                <div class="text-center col-md-12 border rounded mb-3">
                                    <span class="fa fa-user fa-5x mt-2 mb-2"></span>
                                    <h2 class="">Users</h2>
                                    <p class="text-gray">Manage our Users with a full control on Creating, Updating and Deleting users</p>
                                    <p><a class="btn btn-submit rounded" href="{{route('admin.users.index')}}" role="button">View Users</a></p>
                                </div>

                                <div class="text-center col-md-12 border  rounded mb-3">
                                    <span class="fa fa-wpforms fa-5x mt-2 mb-2"></span>
                                    <h2 class="">Questionnaires</h2>
                                    <p class="text-gray">Manage our Users with a full control on Creating, Updating and Deleting users</p>
                                    <p><a class="btn btn-submit rounded" href="{{route('admin.questionnaires.index')}}" role="button">View Questionnaires</a></p>
                                </div>
                                <div class="text-center col-md-12 border  rounded mb-3">
                                    <span class="fa fa-building-o fa-5x mt-2 mb-2"></span>
                                    <h2 class="">Projects</h2>
                                    <p class="text-gray">Manage our Users with a full control on Creating, Updating and Deleting users</p>
                                    <p><a class="btn btn-submit rounded" href="{{route('admin.projects.index')}}" role="button">View Projects</a></p>
                                </div>
                            </div>

            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </main>
    @endsection