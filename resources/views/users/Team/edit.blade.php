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
                <h3 class="text-xl text-gray font-weight-bold">{{__('Update Profile')}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('teams.update',$team->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>{{__('Name')}}</label>
                        <input type="text" value="{{$team->name}}" class="form-control" name="name">
                    </div>
                    <div class="form-group mt-2">
                        <label>{{__('Job')}}</label>
                        <input type="text" value="{{$team->job}}" class="form-control " name="job">
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">
                            <label>Facebook</label>
                            <input type="text" value="{{$team->facebook}}"  class="form-control" name="facebook">
                        </div>
                        <div class="col">
                            <label>Instagram</label>
                            <input type="text" value="{{$team->instagram}}"  class="form-control" name="instagram">
                        </div>
                        <div class="col">
                            <label> twitter</label>
                            <input type="text" value="{{$team->twitter}}"  class="form-control" name="twitter">
                        </div>
                        <div class="col">
                            <label>Linked In</label>
                            <input type="text" value="{{$team->linked_in}}"  class="form-control" name="linked_in">
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <label>{{__('Information')}}</label>
                        <input type="textarea" value="{{$team->description}}"  class="form-control" name="description" cols="5">
                    </div>
                    <div class="form-group mt-2">
                        <label>{{__('Image Parson')}}</label>
                        <input type="file"  class="form-control" name="file">
                    </div>


                    <div class="form-group mt-2">
                        <input type="submit" value="Update" class="btn btn-primary my-4 rounded">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection