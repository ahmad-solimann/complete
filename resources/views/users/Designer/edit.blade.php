@extends('admin.dashboard')

@section('content')

    <div class="container px-5 mt-4">
        <div class="card">

            <div class="card-header d-flex">
                <h3 class="text-xl text-gray font-weight-bold">{{__('Update Designer')}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('designers.update',$designer->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>{{__('Title')}}</label>
                        <input type="text" value="{{$designer->title}}" class="form-control" name="title">
                    </div>
                    <div class="form-group mt-2">
                        <label>{{__('Address')}}</label>
                        <input type="text" value="{{$designer->address}}" class="form-control " name="address">
                    </div>
                    <div class="form-group mt-2">
                        <label>{{__('Project Date')}}</label>
                        <input type="date" value="{{$designer->project_date}}"  class="form-control" name="project_date">
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">
                            <label>{{__('Information')}}</label>
                            <textarea type="text" placeholder="{{$designer->info}}"  class="form-control" name="info" cols="5"></textarea>
                        </div>
                        <div class="col ml-4">
                            <label>{{__('Select category Project')}}</label>
                            <select class="form-control" name="category_id" >
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group mt-2">
                        <input type="submit" value="{{__('Update')}}" class="btn btn-primary my-4 rounded">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection