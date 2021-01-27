@extends('users.layouts.app')
@section('content')
    <style type="text/css">
        a:hover{
            text-decoration: none;
        }
    </style>
    <section id="hero" class="d-flex align-items-center ">
        <div class="container position-relative"  data-aos="fade-up" data-aos-delay="500">

            <h1 class="{{isArabic()?"text-right":""}}">{{__('Welcome To Sihr AL-Sharq')}}</h1>
            <h2 class="{{isArabic()?"text-right":""}}"> {{__('Interior Design')}} | {{__('Architecture')}} | {{__('Landscape')}} | {{__('MEP Solutions')}}</h2>
            <a href="{{route('questionnaires.index')}}" class="btn-get-started" style="float: {{isArabic()?"right":""}};">{{__('Get Started')}}</a>
        </div>
    </section>
    @if($models->count() >= 1)
        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="section-title">
                    <span>{{__('3D Model Design')}}</span>
                    <h2>{{__('3D Model Design')}}</h2>

                </div>

                <div class="row">
                    @foreach($models as $model)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                            <div class="card" style="width: 18rem;">
                                @if($model->files)
                                    @foreach($model->files as $file)
                                        @if($file->is_image('models/'.$model->id."/".$file->file))
                                            <img class="card-img-top" src="{{asset('models/'.$model->id."/".$file->file)}}" alt="Card image cap">
                                        @endif
                                    @endforeach

                                @endif
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{$model->name}}</h5>
                                    <p class="card-text">{{$model->description}}</p>
                                    <a href="{{route('payment',$model->id)}}" class="btn rounded-pill" style="background: #0c0c0c;color: #e9e9e9;"><strong class>{{__('Buy')}} {{$model->price}} $</strong></a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="d-flex justify-content-center">
                    {!! $models->links('vendor.pagination.custom') !!}
                </div>
            </div>

        </section><!-- End Services Section -->
    @endif
    @if($designers->count() >= 1)
        <section id="portfolio" class="portfolio">
            <div class="container">

                <div class="section-title">
                    <span>{{__('Our Designer')}}</span>
                    <h2>{{__('Our Designer')}}</h2>

                </div>

                <div class="row" data-aos="fade-up">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">{{__('All')}}</li>
                            @foreach($categories as $category)
                                <li data-filter=".filter-{{explode(' ',$category->name)[0]}}">{{$category->name}}</li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="150">
                    @foreach($categories as $category)
                        @foreach($category->designers as $designer)
                            <div class="col-lg-4 col-md-6 portfolio-item filter-{{$category->name}}">
                                <img src="{{asset('designer/'.$designer->id."/".$designer->files[0]->file)}}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>{{$designer->title}}</h4>
                                    <p>{{$designer->address}}</p>
                                    <a href="{{asset('designer/'.$designer->id."/".$designer->files[0]->file)}}" data-gall="portfolioGallery" class="venobox preview-link"
                                       title="{{$designer->title}}"><i class="bx bx-plus"></i></a>
                                    <a href="{{route('designers.show',$designer->id)}}" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>

            </div>
        </section>
    @endif
    <!-- ======= Team Section ======= -->
    @if($teams->count() >= 1)
        <section id="team" class="team">
            <div class="container">

                <div class="section-title">
                    <span>{{__('Team')}}</span>
                    <h2>{{__('Team')}}</h2>
                </div>

                <div class="row">
                    @foreach($teams as $team)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                            <div class="member">
                                @if($team->file)
                                    <img src="{{asset('Team/'. $team->file->file)}}" alt="">
                                @endif
                                <h4>{{$team->name}}</h4>

                                <span>{{$team->job}}</span>
                                <p>
                                    {{$team->description}}
                                </p>
                                <div class="social">
                                    @if($team->facebook)
                                        <a href="{{$team->facebook}}"><i class="icofont-facebook"></i></a>
                                    @endif
                                    @if($team->instagram)
                                        <a href="{{$team->instagram}}"><i class="icofont-instagram"></i></a>
                                    @endif
                                    @if($team->linkedin)
                                        <a href="{{$team->linkedin}}"><i class="icofont-linkedin"></i></a>
                                    @endif
                                    @if($team->twitter)
                                        <a href="{{$team->twitter}}"><i class="icofont-twitter"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </section>
        <!-- End Team Section -->
    @endif
@endsection