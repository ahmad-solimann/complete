@extends('admin.layouts.master')
@section('content')
    <div class="container my-card-show px-0 px-lg-4 mt-3" dir="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"rtl" : ""}}" style="width: 60rem;">
        <div class="card">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold  {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"my-card-header-arabic" : "my-card-header"}}">{{__('Users Information')}}</h3>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="table-responsive">
                        @if(count($users)>0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{__('Id')}}</th>
                                <th>{{__('Username')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Verified')}}</th>
                                <th class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"" : "text-right"}}">{{__('Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr style="vertical-align: center">
                                    <td><span class="mt-2">{{$user->id}}</span> </td>
                                    <td><span class="mt-1"><a href="{{route('admin.users.show',$user->id)}}">{{$user->username}}</a></span> </td>
                                    <td><span class="mt-2">{{$user->email}}</span></td>
                                    <td>
                                        <span class="mt-2">
                                            @if($user->verified)
                                                {{__('Yes')}}
                                            @else
                                                {{__('No')}}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="d-flex justify-content-end">
                                        <a href="{{route('admin.users.show',$user->id)}}" title="{{__('Show')}}"> <button class="btn btn-outline-submit actions-buttons" style="width: 2.5rem" ><span class="fa fa-caret-square-o-right fa-2x"></span></button> </a>
                                        <a href="{{route('admin.users.edit',$user->id)}}" title="{{__('Edit')}}" id="a-edit"> <button class="btn btn-outline-submit actions-buttons"style="width: 2.5rem" ><span class="fa fa-edit fa-2x"></span></button> </a>
                                        <a class="btn btn-outline-submit rounded confirmation" title="{{__('Delete')}}" id="a-delete" style="width:2.5rem" href="javascript:void(0);">
                                            <form action="{{route('admin.users.destroy',$user->id)}}" method="POST" id="delete-form" class="actions-buttons">
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
                                <p>{{__('There are no users yet')}}</p> <a href="{{route('admin.users.create')}}"><button class="btn px-2 py-2 rounded" style="background-color: #f2f2f2">{{__('Add New User?')}}</button></a>
                            </div>
                        @endif
                        <hr>
                        <div class="row d-flex justify-content-between" style="margin:0 2rem;">
                            <div><a href="javascript:history.back()"> <button class="btn btn-submit rounded rounded-b-circle float-right" style="width: 5rem">{{__('Back')}}</button> </a> </div>
                            <div class="text-small">
                                {{$users->links()}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection