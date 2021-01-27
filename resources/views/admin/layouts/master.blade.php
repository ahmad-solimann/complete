<!doctype html>
<html lang="en">
<head>
    @include('admin.layouts.partials._meta')
</head>
<body class="{{\Illuminate\Support\Facades\App::currentLocale()=='ar' ?"arabic-font rtl" : "english-font"}}">
@include('admin.layouts.base._sidebar')




<div class="page">
    @include('admin.layouts.base.navbar')
    <div dir="ltr" class="loader1 centered" id="loader-page" style="display: block;">Loading...</div>
    <div id="main-page" style="display: none">
        @if(\Illuminate\Support\Facades\Session::has('success'))
            <h1 class="alert alert-success">{{ Session::get('success') }} <span class="fa fa-check fa-lg"></span></h1>
        @endif

        @yield('content')
    </div>


</div>
@include('admin.layouts.partials._scripts')

@if(auth()->user())
    <script>
        function fetchNotificationCount() {
            fetch(
                '{{ route('admin.notifications-count') }}',
                {'credentials': 'include'}
            ).then(function (response) {
                response.json().then(function (json) {
                    if(json.count>0){
                    document.getElementById('notifications-count').style.display="block";
                    document.getElementById('notifications-count').innerText = json.count;
                    }
                    else{
                        document.getElementById('notifications-count').style.display="none";
                    }

                    setTimeout(fetchNotificationCount, 5000);
                });
            }).catch(function (reason) {
            });
        }
        fetchNotificationCount();
    </script>
    <script>
        function fetchNotifications(){
            $.ajax({
                url: 'admin/notifications/get',
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    var notifications;
                }
            });
        }
    </script>

@endif
</body>
</html>

