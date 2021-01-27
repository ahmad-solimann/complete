@extends('admin.layouts.master')
@section('content')
    <div class="container my-card bg-white px-5 mt-4" dir="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"rtl" : ""}}">
        <div class="card mt-2">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"my-card-header-arabic" : "my-card-header"}}">{{__('Update current user')}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('admin.users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('Username')}}</label>
                        <input type="text" placeholder="{{__('Username')}}" class="form-control" name="username" value="{{$user->username ? $user->username : "" }}" >
                    </div>
                    <div class="form-group mt-2">
                        <label class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('Password')}}</label>
                        <input type="password" placeholder="{{__('Password')}}" class="form-control " name="password">
                    </div>
                    <div class="form-group mt-2 mb-1">
                        <label class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('Email')}}</label>
                        <input type="email" placeholder="{{__('Email')}}" class="form-control" name="email" value="{{$user->email ? $user->email : "" }}">
                    </div>
                    <div class="checkbox mt-2 {{isArabic()?"text-right":""}}">
                        <label class="mx-2 mt-2 py-1 px-2 rounded" style="background-color:rgba(49,47,57,0.15);" ><input type="checkbox" value="1" name="verified"> {{__('Verified')}}</label>
                    </div>
                    <div class="form-row mb-3 mt-1 row">
                        <div class="col-12 col-md-6">
                            <label class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('First Name')}}</label>
                            <input type="text" placeholder="{{__('First Name')}}" class="form-control" name="first_name" value="{{$user->first_name ? $user->first_name : "" }}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('Last Name')}}</label>
                            <input type="text" placeholder="{{__('Last Name')}}" class="form-control" name="last_name" value="{{$user->last_name ? $user->last_name : "" }}">
                        </div>

                    </div>
                    <div class="form-group " style="display: none;">
                        <label>Emarites National ID</label>
                        <input type="text" placeholder="Emarites National ID" class="form-control" name="emirates_national_id">
                    </div>
                    <div class="form-group mt-2">
                        <label class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('City')}}</label>
                        <input type="text" placeholder="{{__('City')}}" class="form-control" name="city" value="{{$user->city ? $user->city : "" }}">
                    </div>
                    <div class="form-row mt-2 mb-3 row">
                        <div class="col-12 col-md-6">
                            <label class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('Address')}}</label>
                            <input type="text" placeholder="{{__('Address')}}" class="form-control" name="address_1" value="{{$user->address_1 ? $user->address_1 : "" }}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('Alternative Address')}}</label>
                            <input type="text" placeholder="{{__('Alternative Address')}}" class="form-control" name="address_2" value="{{$user->address_2 ? $user->address_2 : "" }}">
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('Phone')}}</label>
                        <input type="text" placeholder="{{__('Phone')}}" class="form-control" name="phone" value="{{$user->phone ? $user->phone : "" }}">
                    </div>
                    <br>
                    <hr>
                    <div class="form-group mt-2">
                        <div class="d-flex justify-content-between mt-1 {{isArabic()?"pull-right":"pull-left"}}">
                            <input type="submit" value="{{__('Update')}}" class="btn btn-submit rounded pull-right" style="width: 5rem;display: block;" id="btn-create">
                            <span id="del-btn" class="btn btn-outline-danger rounded mx-2" onclick="javascript:history.back()" style="width: 4.5rem; display: block;">{{__('Cancel')}}</span>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>

@endsection