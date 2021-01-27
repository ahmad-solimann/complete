{{--@extends('admin.dashboard')--}}
{{--@section('content')--}}
{{--    <div class="container px-5 mt-4">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header d-flex">--}}
{{--                <h3 class="text-xl text-gray font-weight-bold">{{__('Team')}}</h3>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>{{__('Id')}}</th>--}}
{{--                                <th>{{__('Name')}}</th>--}}
{{--                                <th>{{__('Job')}}</th>--}}
{{--                                <th>{{__('Actions')}}</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($teams as $team)--}}
{{--                                <tr style="vertical-align: center">--}}
{{--                                    <td>{{$team->id}}</td>--}}
{{--                                    <td>{{$team->name}}</td>--}}
{{--                                    <td>{{$team->job}}</td>--}}
{{--                                    <td class="d-flex justify-content-end">--}}
{{--                                        <a href="{{route('teams.show',$team->id)}}"> <button class="btn btn-primary rounded mr-1" style="width: 4.5rem" >{{__('Show')}}</button> </a>--}}
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
                <h3 class="text-xl text-black font-weight-bold  {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"my-card-header-arabic" : "my-card-header"}}">{{__('Employees Information')}}</h3>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{route('choice')}}" method="get">
                        @if(count($teams)>0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{__('Id')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Job')}}</th>
                                    <th>{{__('Actions')}}</th>
                                    <th>{{__('Choice Show')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teams as $member)
                                    <tr style="vertical-align: center">
                                        <td><span class="mt-2">{{$member->id}}</span> </td>
                                        <td><span class="mt-2">{{$member->name}}</span> </td>
                                        <td><span class="mt-2">{{$member->job}}</span></td>
                                        <td >
                                            <a href="{{route('teams.show',$member->id)}}" title="{{__('Show')}}"> <button class="btn btn-outline-submit actions-buttons" style="width: 2.5rem" ><span class="fa fa-caret-square-o-right fa-2x"></span></button> </a>
                                            <a href="{{route('teams.edit',$member->id)}}" title="{{__('Edit')}}" id="a-edit"> <button class="btn btn-outline-submit actions-buttons"style="width: 2.5rem" ><span class="fa fa-edit fa-2x"></span></button> </a>
                                            <a class="btn btn-outline-submit rounded confirmation" title="{{__('Delete')}}" id="a-delete" style="width:2.5rem" href="javascript:void(0);">
                                                <form action="{{route('teams.destroy',$member->id)}}" method="POST" id="delete-form" class="actions-buttons">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <span class="fa fa-trash fa-2x delete-btn"></span>

                                            </a>
                                        </td>
                                        <td class="">
                                                <span class="mt-2">
                                                    <input type="checkbox" name="teams[]" value="{{$member->id}}">
                                                </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>


                            </table>
                        @else
                            <div class="{{isArabic()?"text-right":""}}">
                                <p>{{__('There are no team information yet')}}</p>
{{--                                <a href="{{route('admin.users.create')}}"><button class="btn px-2 py-2 rounded" style="background-color: #f2f2f2">{{__('Add New User?')}}</button></a>--}}
                            </div>
                        @endif

                        <hr>
                        <div class="row d-flex justify-content-between" style="margin:0 2rem;">
                            <div class="pull-right"><a href="javascript:history.back()"> <button class="btn btn-submit rounded rounded-b-circle float-right" style="width: 5rem">{{__('Back')}}</button> </a> </div>
                            <div class="text-small">
{{--                                {{$users->links()}}--}}
                            </div>
                            <div class="pull-left"> <button class="btn btn-submit rounded rounded-b-circle float-right" style="width: 5rem">{{__('Display')}}</button></div>

                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection