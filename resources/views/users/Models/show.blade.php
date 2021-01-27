@extends('users.layouts.app')
@section('content')
    <br>
    <br>
    <br>
    @if($models->count() > 0)
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


    @endsection