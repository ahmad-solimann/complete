{{--@extends('admin.dashboard')--}}
{{--@section('content')--}}
{{--    <div class="container px-5 mt-4">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header d-flex">--}}
{{--                <h3 class="text-xl text-gray font-weight-bold">{{__('Designer Info')}}</h3>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>{{__('Id')}}</th>--}}
{{--                                <th>{{__('Title')}}</th>--}}
{{--                                <th>{{__('Address')}}</th>--}}
{{--                                <th>{{__('Project Date')}}</th>--}}
{{--                                <th >{{__('Actions')}}</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($designers as $designer)--}}
{{--                                <tr style="vertical-align: center">--}}
{{--                                    <td>{{$designer->id}}</td>--}}
{{--                                    <td>{{$designer->title}}</td>--}}
{{--                                    <td>{{$designer->address}}</td>--}}
{{--                                    <td>{{$designer->project_date}}</td>--}}

{{--                                    <td class="d-flex justify-content-end">--}}
{{--                                        <a href="{{route('designers.edit',$designer->id)}}"> <button class="btn btn-primary rounded mr-1" style="width: 4.5rem" >{{__('Edit')}}</button> </a>--}}
{{--                                        <form action="{{route('designers.destroy',$designer->id)}}" method="POST">--}}
{{--                                            @CSRF--}}
{{--                                            @method('DELETE')--}}
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
    <div class="container my-card-show px-0 px-lg-4 mt-3" dir="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"rtl" : ""}}" style="width: 60rem;">
        <div class="card">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold  {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"my-card-header-arabic" : "my-card-header"}}">{{__('Designs Information')}}</h3>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="table-responsive">
                        @if(count($designers)>0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{__('Id')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Address')}}</th>
                                    <th>{{__('Project Date')}}</th>
                                    <th class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"" : "text-right"}}">{{__('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($designers as $design)
                                    <tr style="vertical-align: center">
                                        <td><span class="mt-2">{{$design->id}}</span> </td>
                                        <td><span class="mt-2">{{$design->title}}</span> </td>
                                        <td><span class="mt-2">{{$design->address}}</span></td>
                                        <td><span class="mt-2">{{$design->project_date}}</span></td>
                                        <td class="d-flex justify-content-end">
{{--                                            <a href="{{route('admin.users.show',$user->id)}}" title="{{__('Show')}}"> <button class="btn btn-outline-submit actions-buttons" style="width: 2.5rem" ><span class="fa fa-caret-square-o-right fa-2x"></span></button> </a>--}}
                                            <a href="{{route('designers.edit',$design->id)}}" title="{{__('Edit')}}" id="a-edit"> <button class="btn btn-outline-submit actions-buttons"style="width: 2.5rem" ><span class="fa fa-edit fa-2x"></span></button> </a>
                                            <a class="btn btn-outline-submit rounded confirmation" title="{{__('Delete')}}" id="a-delete" style="width:2.5rem" href="javascript:void(0);">
                                                <form action="{{route('designers.destroy',$design->id)}}" method="POST" id="delete-form" class="actions-buttons">
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
                                <p>{{__('There are no designs yet')}}</p> <a href="{{route('designers.create')}}"><button class="btn px-2 py-2 rounded" style="background-color: #f2f2f2">{{__('Add New Design?')}}</button></a>
                            </div>
                        @endif
                        <hr>
                        <div class="row d-flex justify-content-between" style="margin:0 2rem;">
                            <div><a href="javascript:history.back()"> <button class="btn btn-submit rounded rounded-b-circle float-right" style="width: 5rem">{{__('Back')}}</button> </a> </div>
                            <div class="text-small">
{{--                                {{$designs->links()}}--}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection