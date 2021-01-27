@extends('admin.layouts.master')
@section('content')
    <div class="container my-card bg-white mt-4" dir="{{isArabic() ? "rtl" : ""}}" style="width: 95%; max-width: 50rem">
        <div class="card mt-2">
            <div class="card-header">
                <h3 class="text-black {{isArabic() ? "my-card-header-arabic" : "my-card-header"}}">{{__('Questionnaire By')}}
                  <a href="{{route('admin.users.show',$questionnaire->user->id)}}"> <span class="font-weight-bold text-xl text-gray"> {{$questionnaire->user->username}} </span> </a>
                </h3>
            </div>
            <div class="card-body" id="project-show-body">
                <dl class="row {{isArabic()?"text-right":""}}">
                    <span class="col-sm-3 font-weight-bold">{{__('Project Name')}}</span>
                    <span class="col-sm-9">{{$questionnaire->name}}</span>
                    <span class="col-sm-3 font-weight-bold mt-2">{{__('Project Owner')}}</span>
                    <span class="col-sm-9 mt-2">{{$questionnaire->user->username}}</span>
                    <span class="col-sm-3 font-weight-bold mt-2 mb-2">{{__('Project Address')}}</span>
                    <span class="col-sm-9 mt-2 mb-2">{{$questionnaire->project_address}}</span>
                    <span class="col-sm-3 font-weight-bold mt-2">{{__('Project Description')}}</span>
                    <span class="col-sm-9 mt-2">{{$questionnaire->project_description}}</span>


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
                    @if(isset($questionnaire->style))
                            {{$questionnaire->style->type}}&nbsp;-&nbsp;<span class="font-weight-bold "> {{$questionnaire->style->name}}</span>
                        @else <span class="text-xsmall">{{__('Not Selected')}}</span>
                        @endif
                    </span>
                    </span>
                </dl>
                <hr>
                <div class="form-group mt-2">
                    <div class="d-flex justify-content-between mt-1 {{isArabic()?"pull-right":"pull-left"}}">
                        <a href="javascript:history.back()"> <button class="btn btn-submit rounded rounded-b-circle float-right" style="width: 5rem">{{__('Back')}}</button> </a>
                        <a class="btn btn-danger rounded rounded-b-circle mx-2 confirmation" href="javascript:void(0);" style="width: 5.2rem">
                            <form action="{{route('admin.questionnaires.destroy',$questionnaire->id)}}" method="POST" id="delete-form">
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