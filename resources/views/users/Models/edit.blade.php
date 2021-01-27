@extends('admin.dashboard')

@section('content')

    <div class="container px-5 mt-4">
        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header d-flex">
                <h3 class="text-xl text-gray font-weight-bold">{{__('Update 3D Model')}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('model.update',$model->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>{{__('Title')}}</label>
                        <input type="text" value="{{$model->name}}" class="form-control" name="name">
                    </div>

                    <div class="form-group mt-2">
                        <label>{{__('Price')}}</label>
                        <input type="number" value="{{$model->price}}"  class="form-control" name="price">
                    </div>
                    <div class="form-group mt-2">
                        <label>{{__('Model Image')}}</label>
                        <input type="file"  class="form-control" name="image">
                    </div>
                    <div class="form-group mt-2">
                        <label>{{__('Model Package')}}</label>
                        <input type="file"  class="form-control" name="file">
                    </div>
                    <div class="form-row mb-3">
                            <label>{{__('Information')}}</label>
                            <textarea type="text" value="{{$model->description}}"  class="form-control" name="description" cols="5"></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <input type="submit" value="{{__('Update')}}" class="btn btn-primary my-4 rounded">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection