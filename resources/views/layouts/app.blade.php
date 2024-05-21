<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>laravel 10 task list app</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>



</head>
<body>
    <div class="container">
        <h1>@yield('title')</h1>
        @yield('styles')
        <div>
            @if(session()->has('success'))
                <div>{{session('success')}}</div>

            @endif


            @yield('content')
        </div>
    </div>

</body>
</html>
