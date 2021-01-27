 @extends('users.layouts.app')
@section('content')
    <style>
        .inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
        .inputfile + label {
            font-size: 1.25em;
            font-weight: 700;
            color: white;
            background-color: black;
            display: inline-block;
        }

        .inputfile:focus + label,
        .inputfile + label:hover {
            background-color: gray;
        }
        .inputfile + label {
            cursor: pointer; /* "hand" cursor */
        }
    </style>
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            @php
                $folder = explode('\\',$name);
            @endphp
            <div class="card">
                <h5 class="card-header">{{end($folder)}}</h5>
                <br>
                @if(end($folder)== "Received")
                    <form class="form-inline justify-content-center" action="{{route('upload.file',['dir'=>$name,'id'=>$id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{--@method('PUT')--}}
                        <div class="form-group">
                            <div class="col">
                            <input type="file" name="file[]" id="file" class="inputfile" multiple/>
                            <label class="btn" for="file">Choose a files</label>
                            </div>
                            <div class="col">
                                <button type="submit"  style="background: #0c0c0c; color:#e9e9e9;"  class="btn"><li class="fa fa-upload"></li></button>
                            </div>

                        </div>

                    </form>
                    <hr>
                @endif
                <div class="card-body">
                    <div class="row">
                      {{--@if(end($folder)== "Received" || end($folder)== "Issued")--}}
                        @foreach($folders as $subfolder)
                            @php
                                $temp = explode('/',$subfolder);
                            $replace = str_replace('/','\\',$subfolder);
                            $extension = explode('.',end($temp));
                            @endphp
                                @if(end($folder)== "Received" || end($folder)== "Issued")
                                <div class="col-md-3 col-sm-6 col-6 {{isArabic()?"text-right":""}}">
                                    @if(end($extension) == "pdf")
                                        <a style="color: #000;" href="{{route('down',$replace)}}" title="{{end($temp)}}"><i class="fad fa-file-pdf fa-lg"></i></a>
                                     @elseif(end($extension) == "jpg"|| end($extension) == "PNG"||end($extension) == "bmp" || end($extension) == "svg" ||end($extension) == "jpeg" || end($extension) == "JPG")
                                        <a style="color: #000;" href="{{route('down',$replace)}}" title="{{end($temp)}}"><img src="{{ route('image.display',$replace)}}" alt="" style="width: 90px; height: 90px;"></a>
                                     @elseif(end($extension) == "mp3" || end($extension) == "wav"|| end($extension) == "m4a")
                                    <a style="color: #000;" href="{{route('down',$replace)}}" title="{{end($temp)}}"><i class="fad fa-file-audio fa-5x"></i></a>
                                    @elseif(end($extension) == "mkv" || end($extension) == "mp4")
                                        <a style="color: #000;" href="{{route('down',$replace)}}" title="{{end($temp)}}"><i class="fad fa-file-video fa-5x"></i></a>
                                    @elseif(end($extension) == "zip" || end($extension) == "rar")
                                        <a style="color: #000;" href="{{route('down',$replace)}}" title="{{end($temp)}}"><i class="fad fa-file-archive fa-5x"></i></a>
                                    @else
                                        <a style="color: #000;" href="{{route('down',$replace)}}" title="{{end($temp)}}"><i class="fad fa-file fa-5x"></i></a>
                                     @endif
                                </div>
                                @else
                                <div class="col-md-3 col-sm-6 col-6 {{isArabic()?"text-right":""}}">
                                @if(end($extension) == "pdf")
                                    <a target="_blank" rel="noopener noreferrer" style="color: #000;" href="{{route('read',$replace)}}" title="{{end($temp)}}"><i class="fad fa-file-pdf fa-5x"></i></a>
                                @elseif(end($extension) == "jpg"|| end($extension) == "png"||end($extension) == "bmp" || end($extension) == "svg")
                                        <a style="color: #000;" href="{{route('read',$replace)}}" title="{{end($temp)}}"><img src="{{ route('image.display',$replace)}}" alt="" style="width: 90px; height: 90px;"></a>
                                @elseif(end($extension) == "mp3" || end($extension) == "wav"|| end($extension) == "m4a")
                                    <a target="_blank" rel="noopener noreferrer" style="color: #000;" href="{{route('read',$replace)}}" title="{{end($temp)}}"><i class="fad fa-file-audio fa-5x"></i></a>
                                @elseif(end($extension) == "mkv" || end($extension) == "mp4")
                                    <a target="_blank" rel="noopener noreferrer" style="color: #000;" href="{{route('read',$replace)}}" title="{{end($temp)}}"><i class="fad fa-file-video fa-5x"></i></a>
                                @elseif(end($extension) == "zip" || end($extension) == "rar")
                                    <a style="color: #000;" href="{{route('read',$replace)}}" title="{{end($temp)}}"><i class="fad fa-file-archive fa-5x"></i></a>
                                @else
                                    <a target="_blank" rel="noopener noreferrer" style="color: #000;" href="{{route('read',$replace)}}" title="{{end($temp)}}"><i class="fad fa-file fa-5x"></i></a>
                                @endif
                                </div>
                                @endif
                            @endforeach
                    </div>
                </div>
                <a class="btn" style="background: #0c0c0c; color:#e9e9e9" href="{{ route('projects.show',$id) }}"><li class="fa fa-arrow-left"></li> </a>
            </div>
        </div>
    </section>
@endsection
