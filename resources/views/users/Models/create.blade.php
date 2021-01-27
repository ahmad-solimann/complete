{{--@extends('admin.dashboard')--}}

{{--@section('content')--}}

{{--    <div class="container px-5 mt-4">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header d-flex">--}}
{{--                <h3 class="text-xl text-gray font-weight-bold">{{__('Add new 3D Model')}}</h3>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <form action="{{route('model.store')}}" method="POST" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <div class="form-group">--}}
{{--                        <label>{{__('Name')}}</label>--}}
{{--                        <input type="text" placeholder="name" class="form-control" name="name">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label>{{__('Price')}}</label>--}}
{{--                        <input type="number" placeholder="price" class="form-control " name="price">--}}
{{--                    </div>--}}

{{--                    <div class="form-row mb-3">--}}
{{--                        <div class="col">--}}
{{--                            <label>{{__('Information')}}</label>--}}
{{--                            <textarea type="text"  class="form-control" name="description" cols="5"></textarea>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="form-group mt-2">--}}
{{--                        <label>{{__('Model Image')}}</label>--}}
{{--                        <input type="file"  class="form-control" name="image">--}}
{{--                    </div>--}}
{{--                    <div class="form-group mt-2">--}}
{{--                        <label>{{__('Model Package')}}</label>--}}
{{--                        <input type="file"  class="form-control" name="file">--}}
{{--                    </div>--}}

{{--                    <div class="form-group mt-2">--}}
{{--                        <input type="submit" value="{{__('Add')}}" class="btn btn-primary my-4 rounded">--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}






@extends('admin.layouts.master')
@section('content')
    <div class="container my-card bg-white px-5 mt-4" dir="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"rtl" : ""}}">
        <div class="card mt-2">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"my-card-header-arabic" : "my-card-header"}}">{{__('Add New 3D Model')}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('model.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">{{__('Name')}}*</label>
                        <input type="text" placeholder="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}"  name="name" required>
                        @error('name')
                        <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">{{__('Price')}}*</label>
                        <input type="number" placeholder="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}" name="price" required>
                        @error('price')
                        <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row mb-3">
                        <div class="col">
                            <label class="col-form-label">{{__('Description')}}</label>
                            <textarea type="text"  class="form-control " name="description" cols="6" style="resize: none;"> {{old('description')}}</textarea>
                        </div>

                    </div>
                    <div class="form-group mt-2 ">
                        <label class="col-form-label">{{__('Model Image')}}*</label>
                        <input type="file" id="model-image-input"  class="form-control rounded @error('image') is-invalid @enderror" name="image" required style="max-width: inherit">
                        <img id="model-image" src="#" alt="Model Image" class="mt-2 rounded" style="width: 9rem; display: none"/>
                        @error('image')
                        <div class="text-small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label class="col-form-label">{{__('Model Package')}}*</label>
                        <input type="file"  class="form-control @error('file') is-invalid @enderror" name="file"  required>
                        @error('file')
                        <div class="text-small text-danger">{{ $message }}</div>
                        @enderror

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