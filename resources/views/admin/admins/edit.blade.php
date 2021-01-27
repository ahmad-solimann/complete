@extends('admin.layouts.master')
@section('content')
    <div class="container my-card bg-white px-5 mt-4" dir="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"rtl" : ""}}">
        <div class="card mt-2">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"my-card-header-arabic" : "my-card-header"}}">{{__('Update Current Admin')}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('admin.admins.update',$admin->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('Username')}}</label>
                        <input type="text" placeholder="{{__('Username')}}" class="form-control @error('username') is-invalid @enderror" name="username" value="{{$admin->username ? $admin->username : old('username') }}" >
                        @error('username')
                        <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('Password')}}</label>
                        <input type="password" placeholder="{{__('Password')}}" class="form-control @error('password') is-invalid @enderror " name="password">
                        @error('password')
                        <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-2 mb-1">
                        <label class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"pull-right mr-2" : ""}}">{{__('Email')}}</label>
                        <input type="email" placeholder="{{__('Email')}}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$admin->email ? $admin->email : old('email') }}">
                        @error('email')
                        <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
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