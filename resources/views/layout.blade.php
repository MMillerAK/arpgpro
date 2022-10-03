<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}" >
        <title>ARPGPro</title>
       
        @yield('header')
        @include('shared.bootstrap')
        
        <link rel="stylesheet" href="/css/app.css">

    </head>
    <body class="antialiased">
    @include('shared.navbar')
    <div id=sidebar>

    </div>   
    
    <article>

    @yield('content')
    
    
    </article>

   @include('shared.footer')

</body>
  