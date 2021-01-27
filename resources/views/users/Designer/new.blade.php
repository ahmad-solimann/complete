@extends('admin.layouts.master')
@section('content')
    <div class="container my-card bg-white px-5 mt-4" dir="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"rtl" : ""}}">
        <div class="card mt-2">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"my-card-header-arabic" : "my-card-header"}}">{{__('Add New Design')}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('designers.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label {{isArabic()?"pull-right mr-2" : ""}}">{{__('Title')}}*</label>
                        <input type="text" placeholder="title" class="form-control @error('image') is-invalid @enderror" value="{{old('title')}}" name="title" required>
                        @error('title')
                        <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label class="col-form-label {{isArabic()?"pull-right mr-2" : ""}}">{{__('Address')}}</label>
                        <input type="text" placeholder="Address" class="form-control" value="{{old('address')}}" name="address">
                    </div>
                    <div class="form-group mt-2">
                        <label class="col-form-label {{isArabic()?"pull-right mr-2" : ""}}">{{__('Project Date')}}</label>
                        <input type="date"  class="form-control" name="project_date" value="{{old('project_date')}}">
                    </div>
                    <div class="form-row  mb-3 row">
                        <div class="col-12 col-lg-7">
                            <label class="col-form-label {{isArabic()?"pull-right mr-2" : ""}}">{{__('Description')}}</label>
                            <textarea type="text"  class="form-control" name="info" cols="6" style="resize: none;">{{old('info')}}</textarea>
                        </div>
                        <div class="col-12 col-lg-5">
                            <label class="col-form-label">{{__('Select category Project')}}*</label>
                            <select class="rounded form-control" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                            @if($category->id == old('category_id'))
                                            selected
                                            @endif
                                            >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group mt-2">
                        <label class="col-form-label {{isArabic()?"pull-right mr-2" : ""}}">{{__('Project Photos')}}*</label>
                        <input type="file"  class="form-control" name="file[]" multiple required>
                    </div>

                    <br>
                    <hr>
                    <div class="form-group mt-2">
                        <div class="d-flex justify-content-between mt-1 {{isArabic()?"pull-right":"pull-left"}}">
                            <input type="submit" value="{{__('Add')}}" class="btn btn-submit rounded pull-right" style="width: 5rem;display: block;" id="btn-create">
                            <span id="del-btn" class="btn btn-outline-danger rounded mx-2" onclick="javascript:history.back()" style="width: 4.5rem; display: block;">{{__('Cancel')}}</span>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>

@endsection