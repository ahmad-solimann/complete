@extends('admin.layouts.master')
@section('content')
    <div class="container my-card-show px-0 px-lg-4 mt-3" dir="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"rtl" : ""}}" style="width: 60rem;">
        <div class="card">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"my-card-header-arabic" : "my-card-header"}}">{{__('All Notifications')}}</h3>
            </div>
            <div class="card-body" style="margin-top: -1.25rem; padding: 1.25rem 0.4rem;">
                <div class="table-responsive">
                    @if(count($notificationsAll))
                    <table class="table">
                        <ul class="list-group" id="notifications-list-all">
                            @foreach($notificationsAll as $notification)
                                <li class="list-group-item flex d-inline-flex justify-content-between" style="{{isArabic()?"margin-right: -1rem;":"margin-left:-1rem;"}}">
                                    @if($notification->type=='App\Notifications\SubmittedQuestionnaire')
                                        <div class="notification-content col-7 col-md-8">
                                            <a  class="@if($notification->read()) text-gray @else text-dark read-link @endif {{isArabic()?"pull-right":""}}" data-notification="{{$notification->id}}" href="{{route('admin.questionnaires.show',$notification->data['QuestionnaireId'])}}">
                                                <i class="text-gray fa fa-flag fa-lg {{isArabic()?"ml-1 pull-right":"mr-1"}}"></i>
                                                {{$notification->data['username'] .__(' has submitted a new questionnaire')}}
                                            </a>
                                        </div>
                                    @elseif($notification->type=='App\Notifications\RegisteredUser')
                                        <div class="notification-content col-7 col-md-8">
                                            <a  class=" @if($notification->read()) text-gray @else text-dark read-link @endif {{isArabic()?"pull-right":""}} " data-notification="{{$notification->id}}" href="{{route('admin.users.show',$notification->data['userId'])}}">
                                                <i class="text-gray fa fa-user fa-lg  {{isArabic()?"ml-1 pull-right":"mr-1"}}"></i>
                                                {{$notification->data['username'] . __(' has joined us!')}}
                                            </a>
                                        </div>
                                    @endif


                                    <div class="text-small text-gray mt-2 col-5 col-md-2 {{isArabic()?"":"text-right"}}">
                                        {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}
                                    </div>
                                    <div class="row flex d-inline-flex col-1 col-md-2 justify-content-start justify-content-lg-end align-content-center">
                                        @if($notification->unread())
                                            <a href="javascript:void(0);" class="mark-asread" id="a-mark-as-read" title="{{__('Mark As Read')}}"> <button class="btn btn-outline-submit rounded markread actions-buttons" style="width: 2.5rem;" id="btn-read" data-notification="{{$notification->id}}">
                                                    <span class="fa fa-check-circle fa-2x"> </span>
                                                </button> </a>
                                        @endif
                                        <a class="btn btn-outline-submit rounded confirmation" id="a-remove" title="{{__('Remove')}}" href="javascript:void(0);" style="width: 2.5rem">
                                            <form action="{{route('admin.notifications-remove',$notification->id)}}" method="POST" id="delete-form" class="actions-buttons">
                                                @csrf
                                                @method('DELETE')
                                                <span class="fa fa-trash fa-2x delete-btn"></span>
                                            </form>
                                        </a>
                                    </div>
                                </li>

                            @endforeach
                        </ul>
                    </table>
                    @else
                        <br>
                        <div class="text-center text-gray">
                            <span>{{__('There are no notifications yet')}}</span>
                        </div>
                    @endif
                <hr>
                <div class="row d-flex justify-content-between" style="margin:0 2rem; padding-bottom: 2rem">
                    <div><a href="javascript:history.back()"> <button class="btn btn-submit rounded rounded-b-circle float-right" style="width: 5rem">{{__('Back')}}</button> </a> </div>
                    <div class="text-small">
                        {{$notificationsAll->links()}}
                    </div>
                </div>
                </div>



            </div>
        </div>
    </div>


@endsection