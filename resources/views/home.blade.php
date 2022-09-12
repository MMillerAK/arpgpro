<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ARPGPro</title>
            
        @include('shared.bootstrap')
        
    </head>
    <body class="antialiased">
    @include('shared.navbar')
    <div id=sidebar>

    </div>
    @include('components.home.caroulsel')
    
    <article>

        <div>2
        <header>
        <h1 >A generic title</h1> 
        <p>
        <img src ="/storage/img/jonny.jpg" width="64" height="64"> by author @ @include('util.time')</p>    
        </header>
        </div>
    @include('test.loremipsum')
    </article>

    @include('shared.footer')