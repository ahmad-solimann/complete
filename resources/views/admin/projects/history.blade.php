@extends('admin.layouts.master')
@section('content')
    <div class="container my-card-show px-0 px-lg-4 mt-3" dir="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"rtl" : ""}}" style="width: 60rem;">
        <div class="card">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"my-card-header-arabic" : "my-card-header"}}">{{__('All Project Updates')}}</h3>
            </div>
            <div class="card-body" style="margin-top: -1.25rem; padding: 1.25rem 0.4rem">
                <div class="table-responsive">
                    @if(count($projectHistory))
                        <table class="table">
                            <ul class="list-group" id="notifications-list-all" dir="ltr">
                                @foreach($projectHistory as $historyLog)
                                    <li class="list-group-item" style="{{isArabic()?"margin-right: -1rem;":"margin-left:-1rem;"}}">
                                            <div class="notification-content col-12">
                                                <a  class="">
                                                    <i class="text-gray fa fa-envelope fa-lg mr-1"></i>
                                                    {{$historyLog->message_content}}
                                                </a>
                                            </div>



                                        <div class="text-small text-gray mt-2 col-5 col-md-2 {{isArabic()?"":"text-right"}}">
                                            {{ Carbon\Carbon::parse($historyLog->created_at)->diffForHumans()}}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </table>
                    @else
                        <br>
                        <div class="text-center text-gray">
                            <span>{{__('There are no project updates yet')}}</span>
                        </div>
                    @endif
                    <hr>
                    <div class="row d-flex justify-content-between" style="margin:0 2rem; padding-bottom: 2rem">
                        <div><a href="javascript:history.back()"> <button class="btn btn-submit rounded rounded-b-circle float-right" style="width: 5rem">{{__('Back')}}</button> </a> </div>
                        <div class="text-small">
                            {{$projectHistory->links()}}
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>


@endsection