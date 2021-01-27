@extends('admin.layouts.master')
@section('content')
    <div class="container my-card bg-white px-5 mt-4" dir="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"rtl" : ""}}">
        <div class="card mt-2">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"my-card-header-arabic" : "my-card-header"}}">{{__('Information About Project Updates')}}</h3>
            </div>


            <div dir="ltr" class="loader" style="display: none;">Loading...</div>

            <div class="card-body">
                <form action="{{route('admin.projects.store-updates',$project->id)}}" method="POST" enctype="multipart/form-data" id="my-form">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label class="col-form-label {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('Log your Updates in a Message').' '.__('(Optional)')}}</label>
                        <textarea dir="ltr" type="text" class="form-control send-info-textarea" rows="4" id="log-msg" name="msg-log" placeholder="Example:&#10;Admin2 has uploaded 2 new files to Issued Directory.&#10;"></textarea>
                        <span class="text-xsmall">This message will only be shown for Admins</span> <br>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-form-label {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('Send Email about Updates').' '.__('(Optional)')}}</label>
                        <textarea dir="ltr" type="text" class="form-control send-info-textarea" rows="4" id="email-to-user" name="email-to-user" placeholder="Example:&#10;Hello Mr.Mohammad&#10;We've updated the project design as you've requested&#10;Regards!"></textarea>
                        <span class="text-xsmall"><span class="fa fa-warning" style="font-size: 0.7rem"></span>
                            Write Formally!<br>This email will go to <b>Project Owner</b>
                        </span> <br>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                         <span id="send-info-btn" class="btn btn-submit mt-2 rounded" style="width: 8.8rem">{{__('Send Updates')}}&nbsp;
                        <span class="fa fa-send" style="font-size: 0.8rem"></span>
                    </span>
                        </div>
                        <div>
                            <a href="{{route('admin.projects.show',$project->id)}}">
                                <span id="skip-btn" class="btn btn-submit rounded mt-1" style="width: 4.5rem">{{__('Skip')}}</span>
                            </a>
                        </div>
                    </div>



                </form>



            </div>
        </div>
    </div>

@endsection