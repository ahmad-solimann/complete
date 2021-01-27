@extends('admin.layouts.master')
@section('content')
    <div class="container my-card bg-white px-5 mt-4" dir="{{isArabic()?"rtl" : ""}}">
        <div class="card mt-2">
            <div class="card-header d-flex">
                <h3 class="text-xl text-black font-weight-bold {{isArabic()?"my-card-header-arabic" : "my-card-header"}}">{{__('Create New Project')}}</h3>
            </div>
            <div dir="ltr" class="loader" style="display: none;">Loading...</div>

            <div class="card-body">
                <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data" id="my-form">
                    @csrf
                   <fieldset id="first-form" style="display: block">
                       <div class="form-group">
                           <label class="col-form-label {{isArabic()?"pull-right mr-2" : ""}}">{{__('Project Owner')}} *</label>
                           <input autocomplete="off" type="text" placeholder="{{__('Enter Owner Username')}}" class="form-control" name="username" id="project-username" required>
                           <div id="username-list">
                           </div>
                       </div>
                       {{ csrf_field() }}
                       <div class="form-group">
                           <label class=" col-form-label {{isArabic()?"pull-right mr-2" : ""}}">{{__('Project Name')}} *</label>
                           <input type="text" placeholder="{{__('Project Name')}}" class="form-control" name="name" required>
                       </div>
                       <div class="form-group">
                           <label class=" col-form-label {{isArabic()?"pull-right mr-2" : ""}}">{{__('Project Address')}} *</label>
                           <input type="text" placeholder="{{__('Project Address')}}" class="form-control" name="address" required>
                       </div>
                       <div class="form-group">
                           <label class="text-small text-dark mt-2 {{isArabic()?"pull-right mr-2" : ""}}" for="demo_overview_minimal">{{__('Select Category For Project')}} *</label><br>
                           <select name="main_category" class="category-select col-12 col-8-md pt-2 pb-2 text-white {{isArabic()?"pull-right":""}}" id="main-category" class="form-control" data-role="select-dropdown" data-profile="minimal">
                               <option  value="" disabled selected>{{__('Select a Main Category')}}</option>
                                                       @foreach($categories as $category)
                               <option  value="{{$category->id}}" >
                                   @if(isset($category->categoryDetails))
                                   {{\Illuminate\Support\Str::ucfirst($category->categoryDetails->translate(\Illuminate\Support\Facades\Session::get('local'))->name)}}
                                       @else
                                       {{$category->name}}
                                       @endif
                               </option>
                                                           @endforeach
                           </select>
                           <select name="category_id" class="category-select col-12 col-8-lg pt-2 pb-2 text-white mt-3 {{isArabic()?"pull-right":""}}" id="sub-category" class="form-control" data-role="select-dropdown" data-profile="minimal">
                               <option value="" disabled selected>{{__('Select a Sub Category')}}</option>
                           </select>
                           <select name="category_id" class="category-select col-12 col-8-lg pt-2 pb-2 text-white mt-3 {{isArabic()?"pull-right":""}}" id="sub-category-1" class="form-control" data-role="select-dropdown" data-profile="minimal" style="display: none;">

                           </select>
                           <select name="category_id" class="category-select col-12 col-8-md pt-2 pb-2 text-white mt-3 {{isArabic()?"pull-right":""}}" id="sub-category-2" class="form-control" data-role="select-dropdown" data-profile="minimal" style="display: none;">

                           </select>
                           <select name="style_id" class="style-select col-12 col-8-md pt-2 pb-2 text-white mt-3 {{isArabic()?"pull-right":""}}" id="main-style" class="form-control" data-role="select-dropdown" data-profile="minimal">
                               <option value="" disabled selected>{{__('Select a Style')}}</option>
                           </select>
                       </div>
                   </fieldset>
                    <fieldset id="second-form" style="display: none;" >
                        <div class="form-group">
                            <label class="col-form-label {{isArabic()?"pull-right mr-2" : ""}}">{{__('Project Director')}} *</label>
                            <input type="text" placeholder="{{__('Project Director')}}" class="form-control" name="project_director" required>
                        </div>
                        <div class="team-members-div">
                        <div class="form-group mt-2">
                            <label class="col-form-label d-flex justify-content-start">{{__('Team Members')}}</label>
                            <ul dir="ltr" class="list-group team-list">
                                    <span class="text-small team-member" id="add-your-team">
                                        <div>
                                            <span  class="ml-2 mr-2 text-gray {{isArabic()?"pull-right" : ""}} ">{{__('Add your team information here')}}</span>
                                        </div>
                                    </span>
                            </ul>

                            <div class="form-group">
                                <label class="col-form-label {{isArabic()?"pull-right mr-2" : ""}}">{{__('Member Name')}}</label>
                                <input type="text" placeholder="{{__('Member Name')}}" class="form-control" id="member-name">
                               <div id="error-member-name" style="display: none"> <span class="error-class {{isArabic()?"" : ""}}">{{__('* Member name is required')}}</span> <br> </div>
                                <label class="col-form-label {{isArabic()?"pull-right mr-2" : ""}}">{{__('Member Title')}}</label>
                                <input type="text" placeholder="{{__('Member Title')}}" class="form-control" id="member-title">
                                <div id="error-member-title" style="display: none"> <span class="error-class {{isArabic()?"" : ""}}">{{__('* Member title is required')}}</span> <br> </div>
                                <span class="btn btn-submit rounded mt-3" id="btn-add-member">{{__('Add')}}</span>
                            </div>
                        </div>
                        </div>

                        <div class="form-group mt-3">
                            <label class="col-form-label {{isArabic()?"pull-right mr-2" : ""}}">{{__('Execution Time')}}</label>
                            <input type="text" placeholder="{{__('Example: 6 Months')}}" class="form-control" name="execution_time">
                        </div>

                        <div class="mt-2 form-group row">
                            <label class="col-12 col-md-4 col-form-label {{isArabic()?"pull-right" : ""}}">{{__('Start Date')}}</label>
                            <div class="col-12 col-md-8">
                                <input name="start_date" class="form-control" type="date" value="2021-01-05" id="example-date-input">
                            </div>
                        </div>
                        <div class="mt-2 form-group row">
                            <label class="col-12 col-md-4 col-form-label {{isArabic()?"pull-right" : ""}}">{{__('Finish Date')}}</label>
                            <div class="col-12 col-md-8">
                                <input name="end_date" class="form-control" type="date" value="2021-01-05" id="example-date-input">
                            </div>
                        </div>
                    </fieldset>
                    <hr>
                    <div class="d-flex justify-content-between">


                    <div class="{{isArabic()?"pull-right" : ""}}">
                        <span id="previous-form" class="btn btn-submit  rounded" style="width: 5.5rem;display: none;">{{__('Previous')}}</span>
                        <span id="next-form" class="btn btn-submit rounded" style="width: 4.5rem">{{__('Next')}}</span>
                    </div>
                    <div class="d-flex justify-content-between">
{{--                            <a href="javascript:history.back()" class="btn btn-outline-danger rounded rounded-b-circle mx-1" style="width: 4.5rem;" id="btn-cancel"> {{__('Cancel')}}</a>--}}
                        <span class="btn btn-submit rounded pull-right" style="width: 5rem;display: none;" id="btn-create">{{__('Create')}}</span>
                    </div>
                    </div>
                </form>



            </div>
        </div>
    </div>

@endsection