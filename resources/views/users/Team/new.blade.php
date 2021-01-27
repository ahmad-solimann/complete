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
                <h3 class="text-xl text-gray font-weight-bold">{{__('Create Profile')}}</h3>
            </div>
            <div class="card-body">
                <form action="{{route('teams.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>{{__('Name')}}</label>
                        <input type="text"  class="form-control" name="name">
                    </div>
                    <div class="form-group mt-2">
                        <label>{{__('Job')}}</label>
                        <input type="text"  class="form-control " name="job">
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">
                            <label>Facebook</label>
                            <input type="text"   class="form-control" name="facebook">
                        </div>
                        <div class="col">
                            <label>Instagram</label>
                            <input type="text"  class="form-control" name="instagram">
                        </div>
                        <div class="col">
                            <label> twitter</label>
                            <input type="text"   class="form-control" name="twitter">
                        </div>
                        <div class="col">
                            <label>Linked In</label>
                            <input type="text"   class="form-control" name="linked_in">
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <label>{{__('Information')}}</label>
                        <input type="textarea" class="form-control" name="description" cols="5">
                    </div>
                    <div class="form-group mt-2">
                        <label>{{__('Image Parson')}}</label>
                        <input type="file"  class="form-control" name="file">
                    </div>


                    <div class="form-group mt-2">
                        <input type="submit" value="{{__('Add')}}" class="btn btn-primary my-4 rounded">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection