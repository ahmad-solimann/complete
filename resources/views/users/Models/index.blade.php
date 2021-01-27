{{--@extends('admin.dashboard')--}}
{{--@section('content')--}}
{{--    <div class="container px-5 mt-4">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header d-flex">--}}
{{--                <h3 class="text-xl text-gray font-weight-bold">{{__('Models Info')}}</h3>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>{{__('Id')}}</th>--}}
{{--                                <th>{{__('Name')}}</th>--}}
{{--                                <th>{{__('Description')}}</th>--}}
{{--                                <th>{{__('Price')}}</th>--}}
{{--                                <th>{{__('Actions')}}</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($models as $model)--}}
{{--                                <tr style="vertical-align: center">--}}
{{--                                    <td>{{$model->id}}</td>--}}
{{--                                    <td>{{$model->name}}</td>--}}
{{--                                    <td>{{$model->description}}</td>--}}
{{--                                    <td>{{$model->price}}</td>--}}

{{--                                    <td class="d-flex justify-content-end">--}}
{{--                                        <a href="{{route('model.edit',$model->id)}}"> <button class="btn btn-primary rounded mr-1" style="width: 4.5rem" >{{__('Edit')}}</button> </a>--}}
{{--                                        <form action="{{route('model.destroy',$model->id)}}" method="POST">--}}
{{--                                            @CSRF--}}
{{--                                            @method("DELETE")--}}
{{--                                            <button class="btn btn-danger rounded"style="width: 4.5rem" >{{__('Delete')}}</button>--}}
{{--                                        </form>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--@endsection--}}


@extends('admin.layouts.master')
@section('content')
    <div class="container my-card-show px-0 px-lg-4 mt-3" dir="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"rtl" : ""}}" style="width: 55rem;">
        <div class="card">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold  {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"my-card-header-arabic" : "my-card-header"}}">{{__('3D Models Information')}}</h3>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="table-responsive">
                        @if(count($models)>0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{__('Id')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Model Image')}}</th>
                                    <th class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"" : "text-right"}}">{{__('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($models as $model)
                                    <tr style="vertical-align: center">
                                        <td><span class="mt-2">{{$model->id}}</span> </td>
                                        <td><span class="mt-1"><a >{{$model->name}}</a></span> </td>
                                        <td><span class="mt-2">{{$model->price}}</span></td>
                                        <td><img src="\models\{{$model->id."\\".$model->files()->first()->file}}"  style="width:3.5rem"/></td>
                                        <td class="d-flex justify-content-end">
{{--                                            <a href="{{route('admin.users.show',$model->id)}}" title="{{__('Show')}}"> <button class="btn btn-outline-submit actions-buttons" style="width: 2.5rem" ><span class="fa fa-caret-square-o-right fa-2x"></span></button> </a>--}}
                                            <a href="{{route('model.edit',$model->id)}}" title="{{__('Edit')}}" id="a-edit"> <button class="btn btn-outline-submit actions-buttons"style="width: 2.5rem" ><span class="fa fa-edit fa-2x"></span></button> </a>
                                            <a class="btn btn-outline-submit rounded confirmation" title="{{__('Delete')}}" id="a-delete" style="width:2.5rem" href="javascript:void(0);">
                                                <form action="{{route('model.destroy',$model->id)}}" method="POST" id="delete-form" class="actions-buttons">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <span class="fa fa-trash fa-2x delete-btn"></span>

                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>


                            </table>
                        @else
                            <div class="{{isArabic()?"text-right":""}}">
                                <p>{{__('There are no 3D Models yet')}}</p> <a href="{{route('model.create')}}"><button class="btn px-2 py-2 rounded" style="background-color: #f2f2f2">{{__('Add New 3D Model?')}}</button></a>
                            </div>
                        @endif
                        <hr>
                        <div class="row d-flex justify-content-between" style="margin:0 2rem;">
                            <div><a href="javascript:history.back()"> <button class="btn btn-submit rounded rounded-b-circle float-right" style="width: 5rem">{{__('Back')}}</button> </a> </div>
                            <div class="text-small">
{{--                                {{$models->links()}}--}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection