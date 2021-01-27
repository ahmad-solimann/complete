@extends('admin.layouts.master')
@section('content')
    <div class="container my-card bg-white px-5 mt-4" dir="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"rtl" : ""}}">
        <div class="card mt-2">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"my-card-header-arabic" : "my-card-header"}}">{{__('Update Social Media Info')}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('contacts.update',$contact->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>{{__('Phone')}}</label>
                        <input type="text" value="{{$contact->phone}}" class="form-control" name="phone">
                    </div>
                    <div class="form-group mt-2">
                        <label>{{__('Email')}}</label>
                        <input type="text" value="{{$contact->email}}" class="form-control " name="email">
                    </div>
                    <div class="form-group mt-2">
                        <label>{{__('Address')}}</label>
                        <input type="text" value="{{$contact->address}}" class="form-control " name="address">
                    </div>
                    <div class="flex row justify-content-between mb-3">
                        <div class="col-12 col-lg-6">
                            <label>Facebook</label>
                            <input type="text" value="{{$contact->facebook}}"  class="form-control" name="facebook">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label>Instagram</label>
                            <input type="text" value="{{$contact->instagram}}"  class="form-control" name="instagram">
                        </div>
                    </div>
                    <div class="flex row justify-content-between mb-3">
                        <div class="col-12 col-lg-6">
                            <label>Twitter</label>
                            <input type="text" value="{{$contact->twitter}}"  class="form-control" name="twitter">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label>LinkedIn</label>
                            <input type="text" value="{{$contact->linked_in}}"  class="form-control" name="linked_in">
                        </div>
                    </div>
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