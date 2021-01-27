<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        .progress-outer{
            background: #fff;
            border-radius: 50px;
            padding: 25px;
            margin: 10px 0;
            box-shadow: 0 0  10px rgba(209, 219, 231,0.7);
        }
        .progress{
            height: 27px;
            margin: 0;
            overflow: visible;
            border-radius: 50px;
            background: #eaedf3;
            box-shadow: inset 0 10px  10px rgba(244, 245, 250,0.9);
        }
        .progress .progress-bar{
            border-radius: 50px;
        }
        .progress .progress-value{
            position: relative;
            left: -45px;
            top: 4px;
            font-size: 14px;
            font-weight: bold;
            color: #fff;
            letter-spacing: 2px;
        }
        .progress-bar.active{
            animation: reverse progress-bar-stripes 0.40s linear infinite, animate-positive 2s;
        }
        @-webkit-keyframes animate-positive{
            0% { width: 0; }
        }
        @keyframes animate-positive {
            0% { width: 0; }
        }
    </style>
</head>

<body>


<div class="progress-outer">
    <div class="progress">
        <div class="progress-bar progress-bar-info progress-bar-striped active" style="width:{{2*25}}%; box-shadow:-1px 10px 10px rgba(57,56,54,0.35); background-color: rgba(49, 47, 57, 0.87)"></div>
        <div class="progress-value">{{2*25}}%</div>
    </div>
</div>



</body>
</html>



{{--@extends('users.layouts.app')--}}
{{--@section('content')--}}
    <!-- Set up a container element for the button -->
    <
    {{--<section id="breadcrumbs" class="breadcrumbs">--}}
        {{--<div class="container text-center">--}}
           {{--<button onclick="download1(this);" class="btn btn-primary"> test</button>--}}
        {{--</div>--}}

    {{--</section>--}}
    {{--<!-- Include the PayPal JavaScript SDK -->--}}
    {{--<script src="https://www.paypal.com/sdk/js?client-id=Acerq6AwNBN2aKmA-pZXgrmO8YuFVOvo_OQsEijhXAavoRjALlFHb5Cc0pyb-kOERskFCDwisyR4ABOe&currency=USD"></script>--}}

    {{--<script>--}}
         {{--import * as axios from "bootstrap-vue";--}}

         {{--function download1(){--}}
              {{--return  axios.get('download/1',{responseType: 'arraybuffer'}).then(res=>{--}}
                      {{--let blob = new Blob([res.data], {type:'application/*'})--}}
                      {{--let link = document.createElement('a')--}}
                      {{--link.href = window.URL.createObjectURL(blob)--}}
                      {{--link.download = file--}}
                      {{--link.click();--}}
              {{--}--}}

                {{--);--}}
            {{--}--}}

    {{--</script>--}}
    {{--<section id="breadcrumbs" class="breadcrumbs">--}}
    {{--<div class="container text-center">--}}
    {{--<button class="myButton download-pdf" onclick='downloadFile("/download/1", {"x-content": "abc"}, "Cairo.zip")' id="download">Download</button>--}}
    {{--</div>--}}
    {{--</section>--}}
    {{--<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>--}}
    {{--<script type="text/javascript">--}}



        {{--$(document).ready(function(){--}}
            {{--$('#download').click(function(){--}}
                {{--$.ajax({--}}
                    {{--url: '{{route("download",1)}}',--}}
                    {{--type: 'GET',--}}
                    {{--success: function(response){--}}

                     {{----}}
                        {{--window.location = response;--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}
        {{--});--}}
        {{--fetch('{{route("download",10)}}')--}}
            {{--.then(resp => resp.blob())--}}
            {{--.then(blob => {--}}
                {{--const url = window.URL.createObjectURL(blob);--}}
                {{--const a = document.createElement('a');--}}
                {{--a.style.display = 'none';--}}
                {{--a.href = url;--}}
                {{--// the filename you want--}}
                {{--a.download = 'ss.*';--}}
                {{--document.body.appendChild(a);--}}
                {{--a.click();--}}
                {{--window.URL.revokeObjectURL(url);--}}
                {{--alert('your file has downloaded!'); // or you know, something with better UX...--}}
            {{--})--}}
            {{--.catch(() => alert('oh no!'));--}}
        {{--function downloadFile(response) {--}}
            {{--var blob = new Blob([response], {type: 'application/*'});--}}
            {{--var url = URL.createObjectURL(blob);--}}
            {{--location.assign(url);--}}
        {{--}--}}
        {{--$.ajaxSetup({--}}
            {{--headers: {--}}
                {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--}--}}
        {{--});--}}

        {{--$.ajax({--}}
            {{--url: "{{ route('download',1) }}",--}}
            {{--method: 'POST',--}}
            {{--data: {--}}

            {{--}--}}
        {{--})--}}
            {{--.done(downloadFile);--}}
    {{--</script>--}}
{{--@endsection--}}