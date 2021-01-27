@extends('users.layouts.app')
@section('content')
    <style>
        a{
            text-decoration: black;
            color: black;
        }
        a:hover{
            text-decoration: none;

            color:black;
        }
    </style>


    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <div class="mt-3">
                                        <h4>{{$user->username}}</h4>
                                        <p class="text-secondary mb-1">{{$user->email}}</p>
                                        <p class="text-muted font-size-sm">{{$user->address_1}}</p>
                                        <a href="{{route('profiles.edit',$user->id)}}" class="btn" style="background: #0c0c0c; color: #e9e9e9;"><li class="fa fa-edit"></li> {{__('Edit')}}</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            @yield('Questionnaire')
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="float: {{isArabic()?"right":""}}">{{__('Full Name')}}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <h6 class="mb-0" style="float: {{isArabic()?"right":""}}">{{$user->first_name}} {{$user->last_name}}</h6>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="float: {{isArabic()?"right":""}}">{{__('Email')}}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <h6 class="mb-0" style="float: {{isArabic()?"right":""}}">{{$user->email}}</h6>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="float: {{isArabic()?"right":""}}">{{__('Phone')}}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <h6 class="mb-0" style="float: {{isArabic()?"right":""}}">{{$user->phone}}</h6>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0" style="float: {{isArabic()?"right":""}}">{{__('Address')}}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <h6 class="mb-0" style="float: {{isArabic()?"right":""}}">{{$user->address_1}},{{$user->city}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters-sm">
                            <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="text-center"><strong>{{__('Projects')}}</strong></h6>
                                        <hr>
                                        @foreach($projects as $project)
                                            <a href="{{route('projects.show',$project->id)}}"> <p class="text-center"><strong class="text-right">{{$project->name}}</strong> : <small class="text-left">{{$project->created_at}}</small></p></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="text-center"><strong>{{__('Questionnaires')}}</strong></h6>
                                        <hr>
                                        @foreach($questionnaires as $questionnaire)
                                            <a  href="{{route('questionnaires.show',$questionnaire->id)}}"><p class="text-center"><strong class="text-right">{{$questionnaire->id}}</strong> : {{$questionnaire->created_at->format('Y-m-d')}}</p></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection