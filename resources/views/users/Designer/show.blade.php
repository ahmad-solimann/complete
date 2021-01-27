@extends('users.layouts.app')
@section('content')

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <br>
            <br>
            <br>
            <br>
            <div class="portfolio-details-container text-right">

                <div dir="auto" class="owl-carousel portfolio-details-carousel" style="max-height:700px !important; max-width: 1100px !important;" >
                    @foreach($designer->files as $file)
                        <img src="{{asset('Designer/'.$designer->id."/".$file->file)}}" class="img-fluid" style="vertical-align: middle; max-height: 500px; " alt="">
                    @endforeach
                </div>

                <div class="portfolio-info">
                    <h3>{{__('Project information')}}</h3>
                    <ul>
                        <li><strong>{{__('Category')}}</strong>: {{$designer->category->name}}</li>
                        <li><strong>{{__('Address')}}</strong>: {{$designer->address}}</li>
                        <li><strong>{{__('Project Date')}}</strong>: {{$designer->project_date}}</li>
                    </ul>
                </div>

            </div>

            <div class="portfolio-description">
                <h2>{{$designer->title}}</h2>
                <p>
                    {{$designer->info}}
                </p>
            </div>

        </div>
    </section><!-- End Portfolio Details Section -->
@endsection