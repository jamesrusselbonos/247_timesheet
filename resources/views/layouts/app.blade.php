<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    
    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

       
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<script type="text/javascript">
$(document).ready(function() {

    $(".time").click(function(){

        var text = $('button').text();
        var id = $(this).attr('id');
        var token = $(".card-body .hdn-token").val();
        var testID = $(this).attr('testID');
        var randd = Math.floor(Math.random() * 10000);
        var name = $(this).attr('name');

        var d = new Date();

        var month = d.getMonth()+1;
        var day = d.getDate();

        var curDate = d.getFullYear() + '-' + month + '-' + day;
        var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();

        var markup = "<tr><td> <b>" + name + "</b> </td><td>" + curDate + "</td><td>" + time + "</td><td>" + '' + "</td></tr>";
        
        
        var randId = randd;
        if( text == "Time In")
        {
            var rand1 = $(".time").attr('testId', randd);
            console.log(text);
            $(".time").text('Time Out');
            $(".time").removeClass('btn-primary').addClass('btn-danger');

            $.post('/timeIn/' + id,

             {'id':id, 'randId':randId, '_token':token}, 
             function(data){

            console.log(id);

                $("table tbody").append(markup);
            

             });      
        }
        else{

            
            $(".time").text('Time In');
            $(".time").removeClass('btn-danger').addClass('btn-primary');

            $.post('/timeOut/' + id,

             {'id':id, 'testID':testID,'_token':token}, 
             function(data){

            console.log(randId);

             });      
        }

        
    });


});
</script>

</html>