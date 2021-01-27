@extends('users.Profiles.index')
@section('Questionnaire')

    <div class="card">
        <div class="card-body">

            <p class="{{isArabic()?"text-right":""}}"><strong class="text-center">{{__('Category')}} : </strong>{{$questionnaire->category->name}}</p><hr>
            <p class="{{isArabic()?"text-right":""}}"><strong class="text-center">{{__('Description')}} : </strong><small>{{$questionnaire->project_description}}</small></p>
            <hr>
            @if($questionnaire->files)
                <h6 class="text-center"><strong>{{__('Files')}}</strong></h6>
                <hr>
                @foreach($questionnaire->files as $file)
                    <div class="text-center">
                        <a href="{{asset('upload/'.$questionnaire->id."\\". $file->file)}}">{{$file->file}}</a>
                    </div>
                @endforeach
            @else
                <h6 class="text-center"><strong>{{__('No File')}}</strong></h6>
                <hr>
            @endif

            <hr>
            <div class="text-center">
                <a hidden="" href="#" class="btn" style="background: #0c0c0c; color: #e9e9e9; " ><li class="fa fa-edit"></li> {{__('Edit')}}</a>
                {{--<a href="#" class="btn" style="background: #0c0c0c; color: #e9e9e9;"><i class="fa fa-trash" aria-hidden="true"></i> {{__('Delete')}}</a>--}}
                <form action="{{route('questionnaires.destroy',$questionnaire->id)}}" method="POST">
                    @CSRF
                    @method('DELETE')
                    <button class="btn " style="background: #0c0c0c; color: #e9e9e9;" ><i class="fa fa-trash" aria-hidden="true"></i> {{__('Delete')}}</button>
                </form>
            </div>


        </div>
    </div>
@endsection