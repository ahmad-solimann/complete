@extends('admin.layouts.master')
@section('content')
    <div class="container my-card-show px-0 px-lg-4 mt-3" dir="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"rtl" : ""}}" style="width: 70rem">
        <div class="card">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold {{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"my-card-header-arabic" : "my-card-header"}}">{{__('Questionnaires Information')}}</h3>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="table-responsive">
                        @if(count($questionnaires))
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{__('Id')}}</th>
                                    <th>{{__('Project Owner')}}</th>
                                    <th>{{__('Category')}}</th>
                                    <th>{{__('Style')}}</th>

                                    <th class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"" : "text-right"}}">{{__('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($questionnaires as $questionnaire)
                                    <tr style="vertical-align: center">
                                        <td><span class="mt-2">{{$questionnaire->id}}</span> </td>
                                        <td><span class="mt-1"><a href="{{route('admin.users.show',$questionnaire->user->id)}}">{{$questionnaire->user->username}}</a></span> </td>
                                        <td><span class="mt-2">{{getTranslatedName($questionnaire->category->categoryDetails->id)}}</span></td>
                                        <td><span class="mt-2">
                                             @if(isset($questionnaire->style))   {{$questionnaire->style->name}}
                                                 @else {{__('Not Selected')}}
                                                 @endif
                                            </span></td>


                                        <td class="d-flex justify-content-end">
                                            <a href="{{route('admin.questionnaires.show',$questionnaire->id)}}" title="{{__('Show')}}"> <button class="btn btn-outline-submit actions-buttons" style="width: 2.5rem" ><span class="fa fa-caret-square-o-right fa-2x"></span></button> </a>
                                            <a class="btn btn-outline-submit rounded confirmation" title="{{__('Delete')}}" id="a-delete" style="width:2.5rem" href="javascript:void(0);">
                                                <form action="{{route('admin.questionnaires.destroy',$questionnaire->id)}}" method="POST" id="delete-form" class="actions-buttons">
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
                                <p>{{__('There are no questionnaires yet')}}</p>
                            </div>
                        @endif
                        <hr>
                        <div class="row d-flex justify-content-between" style="margin:0 2rem; padding-bottom: 2rem">
                            <div><a href="javascript:history.back()"> <button class="btn btn-submit rounded rounded-b-circle float-right" style="width: 5rem">{{__('Back')}}</button> </a> </div>
                            <div class="text-small">
                                {{$questionnaires->links()}}
                            </div>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection