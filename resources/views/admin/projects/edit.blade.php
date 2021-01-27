@extends('admin.layouts.master')
@section('content')
    <div class="container my-card bg-white px-5 mt-4" dir="{{isArabic() ? "rtl" : ""}}">
        <div class="card mt-2">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold {{isArabic() ? "my-card-header-arabic" : "my-card-header"}}">{{__('Update Current Project')}}</h3>
            </div>
            <div dir="ltr" class="loader" style="display: none;">Loading...</div>

            <div class="card-body">
                <form action="{{route('admin.projects.update',$project->id)}}" method="POST" enctype="multipart/form-data" id="my-form">
                    @csrf
                    @method('PUT')
                    <fieldset id="first-form" style="display: block">
                        <div class="form-group">
                            <label class="col-form-label {{isArabic() ? "pull-right mr-2" : ""}}">{{__('Project Owner')}}</label>
                            <input autocomplete="off" type="text" placeholder="{{__('Enter Owner Username')}}" class="form-control" name="username" id="project-username" value="{{$project->user->username ? $project->user->username : "" }}">
                            <div id="username-list">
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class=" col-form-label {{isArabic()?"pull-right mr-2" : ""}}">{{__('Project Name')}}</label>
                            <input type="text" placeholder="{{__('Project Name')}}" class="form-control" name="name" value="{{$project->name ? $project->name : "" }}">
                        </div>
                        <div class="form-group">
                            <label class=" col-form-label {{isArabic() ? "pull-right mr-2" : ""}}">{{__('Project Address')}}</label>
                            <input type="text" placeholder="{{__('Project Address')}}" class="form-control" name="address" value="{{$project->address ? $project->address : "" }}">
                        </div>
                        <div class="form-group">
                            <span class="text-lg text-dark mt-1 {{isArabic() ? "pull-right" : ""}}" for="demo_overview_minimal">{{__('Current Category')}}</span>
                            <br>
                                <dd aria-label="breadcrumb" dir="ltr">
                                    <ol class="breadcrumb {{isArabic()?"mt-3":"mt-1"}}" dir="{{isArabic()?"rtl":""}}">
                                        @foreach($categoriesTree as $category1)
                                            <li class="breadcrumb-itemm
                            @if(!$loop->last)
                                                    text-dark
                            @else
                                                    active font-weight-bold
                            @endif
                                                    ">{{getTranslatedName($category1)}}
                                                @if(!$loop->last)
                                                &nbsp;/&nbsp;
                                                    @endif
                                            </li>
                                        @endforeach
                                    </ol>
                                </dd>
                            <span class="text-lg text-dark {{isArabic() ? "pull-right mt-1" : ""}}" for="demo_overview_minimal">{{__('Current Style')}}:</span>
                            <span class="mx-1 px-2 rounded py-2 font-weight-bold {{isArabic()?"pull-right":""}}" style="background-color:#e9ecef;">
                               @if(isset($project->style))
                                    {{$project->style->name}}
                               @endif
                            </span> <br>
                            @if(isArabic())
                                <br>
                                @endif


                            <label class="text-small text-dark mt-3 {{isArabic() ? "pull-right" : ""}}" for="demo_overview_minimal">{{__('Update Category and Style for this Project')}}</label>
                            <select name="main_category" class="category-select col-12 pt-2 pb-2 text-white" id="main-category" class="form-control" data-role="select-dropdown" data-profile="minimal">
                                <option  value="" disabled selected>{{__('Select a Main Category')}}</option>
                                {{--                        @foreach($categories as $category)--}}
                                <option  value="{{$category->id}}" > {{\Illuminate\Support\Str::ucfirst($category->categoryDetails->translate(\Illuminate\Support\Facades\Session::get('local'))->name)}} </option>
                                {{--                            @endforeach--}}
                            </select>
                            <select name="category_id" class="category-select col-12 pt-2 pb-2 text-white mt-3" id="sub-category" class="form-control" data-role="select-dropdown" data-profile="minimal">
                                <option value="" disabled selected>{{__('Select a Sub Category')}}</option>
                            </select>
                            <select name="category_id" class="category-select col-12 pt-2 pb-2 text-white mt-3" id="sub-category-1" class="form-control" data-role="select-dropdown" data-profile="minimal" style="display: none;">

                            </select>
                            <select name="category_id" class="category-select col-12 pt-2 pb-2 text-white mt-3" id="sub-category-2" class="form-control" data-role="select-dropdown" data-profile="minimal" style="display: none;">

                            </select>
                            <select name="style_id" class="style-select col-12 pt-2 pb-2 text-white mt-3" id="main-style" class="form-control" data-role="select-dropdown" data-profile="minimal">
                                <option value="" disabled selected>{{__('Select a Style')}}</option>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset id="second-form" style="display: block;" >
                        <div class="form-group">
                            <label class="col-form-label {{isArabic() ? "pull-right mr-2" : ""}}">{{__('Project Director')}}</label>
                            <input type="text" placeholder="{{__('Project Director')}}" class="form-control" name="project_director" value="{{$project->project_director ? $project->project_director : ""}}">
                        </div>
                        <div class="team-members-div">
                            <div class="form-group mt-2">
                                <label class="col-form-label d-flex justify-content-start">{{__('Team Members')}}</label>
                                <ul dir="ltr" class="list-group team-list">
                                    <span class="text-small team-member" id="add-your-team" style="display: {{count($project->teamMembers)>0 ?"none;":"block;"}}"  >
                                        <div>
                                            <span class="ml-2 mr-2 text-gray {{isArabic() ? "pull-right" : ""}} ">{{__('Add your team information here')}}</span>
                                        </div>
                                    </span>
                                    @foreach($project->teamMembers as $teamMember)
                                        <li class="list-group-item team-member d-flex justify-content-between" >
                                        <div>
                                             <b id="team-name-val" class="ml-2">{{$teamMember->name}}</b> &nbsp;|&nbsp;<span id="team-title-val">{{$teamMember->title}}</span>
                                           </div>
                                            <input type="hidden" name="team-members-names[]" value="{{$teamMember->name}}" />
                                            <input type="hidden" name="team-members-titles[]" value="{{$teamMember->title}}" />
                                            <input id="member-id-val" type="hidden" name="team-members-ids[]" value="{{$teamMember->id}}"/>
                                            <div class="flex d-flex mt-1">
                                                <span class="fa fa-edit ml-1 mr-2 team-list-buttons" id="edit-team-member"></span>
                                                <span class="fa fa-trash mr-1 delete-btn team-list-buttons" id="delete-team-member"></span>
                                            </div>

                                        </li>
                                        @endforeach
                                    <input id="team-members-changed" type="hidden" name="team-members-changed" value="0"/>
                                </ul>

                                <div class="form-group">
                                    <label class="col-form-label {{isArabic() ? "pull-right mr-2" : ""}}">{{__('Member Name')}}</label>
                                    <input type="text" placeholder="{{__('Member Name')}}" class="form-control" id="member-name">
                                    <div id="error-member-name" style="display: none"> <span class="error-class {{isArabic() ? "" : ""}}">{{__('* Member name is required')}}</span> <br> </div>
                                    <label class="col-form-label {{isArabic() ? "pull-right mr-2" : ""}}">{{__('Member Title')}}</label>
                                    <input type="text" placeholder="{{__('Member Title')}}" class="form-control" id="member-title">
                                    <input hidden type="text"class="form-control" id="member-id">
                                    <div id="error-member-title" style="display: none"> <span class="error-class {{isArabic() ? "" : ""}}">{{__('* Member title is required')}}</span> <br> </div>
                                    <span class="btn btn-submit rounded mt-3" id="btn-add-member">{{__('Add')}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label class="col-form-label {{isArabic() ? "pull-right mr-2" : ""}}">{{__('Execution Time')}}</label>
                            <input type="text" placeholder="{{__('Example: 6 Months')}}" class="form-control" name="execution_time">
                        </div>

                        <div class="mt-2 form-group row">
                            <label class="col-12 col-md-4 col-form-label {{isArabic() ? "pull-right" : ""}}">{{__('Start Date')}}</label>
                            <div class="col-12 col-md-8">
                                <input name="start_date" class="form-control" type="date" value="2021-01-05" id="example-date-input">
                            </div>
                        </div>
                        <div class="mt-2 form-group row">
                            <label class="col-12 col-md-4 col-form-label {{isArabic() ? "pull-right" : ""}}">{{__('Finish Date')}}</label>
                            <div class="col-12 col-md-8">
                                <input name="end_date" class="form-control" type="date" value="2021-01-05" id="example-date-input">
                            </div>
                        </div>
                    </fieldset>
                    <hr>
                    <div class="d-flex justify-content-between {{isArabic()?"pull-right":"pull-left"}}">
                            <input type="submit" value="{{__('Update')}}" class="btn btn-submit rounded pull-right" style="width: 5rem;display: block;" id="btn-create">
                                <span id="del-btn" class="btn btn-outline-danger rounded mx-2" onclick="javascript:history.back()" style="width: 4.5rem; display: block;">{{__('Cancel')}}</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection