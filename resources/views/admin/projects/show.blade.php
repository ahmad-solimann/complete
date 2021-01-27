@extends('admin.layouts.master')
@section('content')
    <div class="container my-card bg-white mt-4" dir="{{isArabic() ? "rtl" : ""}}" style="width: 85%">
        <div class="card mt-2">
            <div class="card-header d-flex justify-content-between">
                <h3 class="text-xl text-black font-weight-bold {{isArabic() ? "my-card-header-arabic" : "my-card-header"}}">{{__('Project Details')}}</h3>
                <div class="dropdown" id="project-action-dropdown">
                    <span class="" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fa fa-bars float-right fa-2x"></span>
                    </span>
                    <div id="project-dropdown" class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 10rem;margin-left: {{isArabic()?"":"-8.7rem"}}">
                        <a class="project-menu-item dropdown-item" href="{{route('unisharp.lfm.show','url=/Current Projects/'.$project->id)}}" target="_blank">{{__('Project Folder')}}</a>
                        <a class="project-menu-item dropdown-item" href="{{route('admin.projects.send-info',$project->id)}}">{{__('Send e-mail')}}</a>
                        <a class="project-menu-item dropdown-item" href="{{route('admin.projects.history',$project->id)}}">{{__('Project History')}}</a>

                        <a class="project-menu-item dropdown-item" id="close-project-btn" data-project="{{$project->id}}"
                        style="display: @if($project->closed ==0) block @else none @endif"
                        >{{__('Close Project')}}</a>
                        <a class="project-menu-item dropdown-item" id="restore-project-btn" data-project="{{$project->id}}"
                           style="display: @if($project->closed ==1) block @else none @endif"
                        >{{__('Restore Project')}}</a>
                        <a class="project-menu-item dropdown-item" href="{{route('admin.projects.edit',$project->id)}}">{{__('Edit')}}</a>
                        <a class="project-menu-item dropdown-item" href="#">{{__('Delete')}}</a>
                    </div>
                </div>

            </div>
            <div id="project-move-loader" style="display: none;">
            <div dir="ltr" class="loader" >Loading...</div>
            <p class="mt-2 d-flex justify-content-center text-dark">Please Wait</p>
            </div>
            <div class="card-body" id="project-show-body">
                <dl class="row {{isArabic()?"text-right":""}}">
                    <span class="col-sm-3 font-weight-bold">{{__('Project Name')}}</span>
                    <span class="col-sm-9">{{$project->name}}</span>
                    <span class="col-sm-3 font-weight-bold mt-2">{{__('Project Owner')}}</span>
                    <span class="col-sm-9 mt-2">{{$project->user->username}}</span>
                    <span class="col-sm-3 font-weight-bold mt-2 mb-2">{{__('Project Address')}}</span>
                    <span class="col-sm-9 mt-2 mb-2">{{$project->address}}</span>


                    <dt class="col-sm-3 mt-3">{{__('Category')}}</dt>
                    <dd class="col-sm-9" aria-label="breadcrumb" dir="ltr">
                        <ol class="breadcrumb {{isArabic()?"":"mt-1"}}" dir="{{isArabic()?"rtl":""}}">
                            @foreach($categoriesTree as $category1)
                                <li class="breadcrumb-itemm
                            @if(!$loop->last)
                                        text-dark
                            @else
                                        active font-weight-bold
                            @endif
                                        ">{{getTranslatedName($category1)}}
                                    @if(!$loop->last)
                                        &nbsp;/&nbsp;
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </dd>
                    <span class="col-sm-3 font-weight-bold mt-2">{{__('Style')}}</span>
                    <span class="col-sm-9">
                    <span class="mx-1 px-2 rounded py-2{{isArabic()?"pull-right":""}}" style="background-color:#e9ecef; @if(isArabic()) padding-top:.5rem; padding-bottom: .5rem @endif">
                    @if(isset($project->style))
                            {{$project->style->type}}&nbsp;-&nbsp;<span class="font-weight-bold "> {{$project->style->name}}</span>
                        @else <span class="text-xsmall">{{__('Not Selected')}}</span>
                        @endif
                    </span>
                    </span>
                    <span class="col-sm-3 font-weight-bold mt-3">{{__('Project Director')}}</span>
                    <span class="col-sm-9 mt-3">{{$project->project_director}}</span>
                    <span class="col-sm-3 mt-3 font-weight-bold">{{__('Team Members')}}</span>
                    <span class="col-sm-9 mt-2 text-right">
                        <ul dir="ltr" class="list-group team-list mt-1">
                            @foreach($project->teamMembers as $teamMember)
                                <li class="list-group-item team-member" >
                                    <div class="{{isArabic()?"":"float-left"}}">
                                       <span class="fa fa-user"></span> <b id="team-name-val" class="ml-1">{{$teamMember->name}}</b> &nbsp;|&nbsp;<span id="team-title-val">{{$teamMember->title}}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </span>
                    <span class="col-sm-3 font-weight-bold mt-1">{{__('Execution Time')}}</span>
                    <span class="col-sm-9 mt-1">{{$project->execution_time}}</span>
                    <span class="col-sm-3 font-weight-bold mt-1">{{__('Start Date')}}</span>
                    <span class="col-sm-9 mt-1">{{$project->start_date}}</span>
                    <span class="col-sm-3 font-weight-bold mt-1">{{__('Finish Date')}}</span>
                    <span class="col-sm-9 mt-1">{{$project->end_date}}</span>


                </dl>
                <hr>
                <div class="form-group mt-2">
                    <div class="d-flex justify-content-between mt-1 {{isArabic()?"pull-right":"pull-left"}}">
                        <a href="javascript:history.back()"> <button class="btn btn-submit rounded rounded-b-circle float-right" style="width: 5rem">{{__('Back')}}</button> </a>
                        <a class="btn btn-danger rounded rounded-b-circle mx-2 confirmation" href="javascript:void(0);" style="width: 5.2rem">
                            <form action="{{route('admin.projects.destroy',$project->id)}}" method="POST" id="delete-form">
                                @csrf
                                @method('DELETE')
                                {{__('Delete')}}
                                <span class="fa fa-trash"></span>
                            </form>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{--<a href="{{route('unisharp.lfm.show','url=/Current Projects/'.$project->id)}}" target="_blank"> Show folder</a>--}}
    @endsection