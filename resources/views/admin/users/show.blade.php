@extends('admin.layouts.master')
@section('content')
    <div class="container px-5 mt-4 py-5">
        <div class="card">
            <div class="card-header">
                <h1 class="text-gray font-weight-bold">{{$user->username }}<span class="ml-2 text-dark h3">{{__('Details')}}</span> </h1>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">{{__('Username')}}</dt>
                    <dd class="col-sm-8">{{$user->username}}</dd>
                    <dt class="col-sm-4 mt-2">{{__('Email')}}</dt>
                    <dd class="col-sm-8" id="user-email">{{$user->email}}</dd>
                    <dt class="col-sm-4 mt-2">{{__('Verified')}}</dt>
                    <dd class="col-sm-8" id="verified">
                        @if($user->verified==1)
                            {{__('Yes')}}
                            @else
                            {{__('No')}}
                             <button class="btn btn-outline-info rounded rounded-b-circle ml-2" style="width: 4rem" id="btn-verify" data-user="{{$user->id}}">{{__('Verify')}}</button>
                        @endif
                    </dd>
                    @if(isset($user->first_name))
                        <dt class="col-sm-4 text-truncate">{{__('First Name')}}</dt>
                        <dd class="col-sm-8">{{$user->first_name}}</dd>
                    @endif
                    @if(isset($user->last_name))
                        <dt class="col-sm-4 text-truncate">{{__('Last Name')}}</dt>
                        <dd class="col-sm-8">{{$user->last_name}}</dd>
                    @endif
                    @if(isset($user->emirates_national_id))
                        <dt class="col-sm-4 text-truncate">Emirates National Id</dt>
                        <dd class="col-sm-8">{{$user->emirates_national_id}}</dd>
                    @endif
                    @if(isset($user->city))
                        <dt class="col-sm-4 text-truncate">{{__('City')}}</dt>
                        <dd class="col-sm-8">{{$user->city}}</dd>
                    @endif
                    @if(isset($user->address_1))
                        <dt class="col-sm-4 text-truncate">{{__('Address')}}</dt>
                        <dd class="col-sm-8">{{$user->address_1}}</dd>
                    @endif
                    @if(isset($user->address_2))
                        <dt class="col-sm-4 text-truncate">{{__('Alternative Address')}}</dt>
                        <dd class="col-sm-8">{{$user->address_2}}</dd>
                    @endif
                    @if(isset($user->phone))
                        <dt class="col-sm-4 text-truncate">{{__('Phone')}}</dt>
                        <dd class="col-sm-8">{{$user->phone}}</dd>
                    @endif
                </dl>

                <div class="row flex d-inline-flex justify-content-center ml-1">
                    <a href="javascript:history.back()"> <button class="btn btn-outline-primary rounded rounded-b-circle mt-1" style="width: 5rem">{{__('Back')}}</button> </a>
                    <a href="{{route('admin.users.edit',$user->id)}}"> <button class="btn btn-default rounded rounded-b-circle ml-2 mt-1" style="width: 5rem">{{__('Edit')}}</button> </a>
                    <a class="btn btn-danger rounded rounded-b-circle ml-2 mt-1 confirmation" style="width: 9rem" href="javascript:void(0);">
                        <form action="{{route('admin.users.destroy',$user->id)}}" method="POST" id="delete-form">
                            @csrf
                            @method('DELETE')
                            {{__('Delete This User')}}
                        </form>
                    </a>
                </div>

            </div>
        </div>
    </div>


@endsection