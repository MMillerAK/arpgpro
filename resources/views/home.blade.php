<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ARPGPro</title>
            
        @include('shared.bootstrap')
        <style>
        div.c-wrapper
        {
            width: 80%; /* for example */
            margin: auto;
        }

        .carousel-inner > .item > img, 
        .carousel-inner > .item > a > img
        {
        width: 50%; /* use this, or not */
        margin: auto;
        }</style>
    </head>
    <body class="antialiased">
    @include('shared.navbar')
    <div id=sidebar>

    </div>
<!-- banner -->

<img src="/storage/img/banner.png" height=559px>


  


    <!-- carousel -->

    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active text-center" data-bs-interval="10000">
      <img src="/storage/img/placeholder600x400.png" class="" alt="...">
      <br>
      <div class="carousel-caption d-none d-md-block" style="color:white">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>

    <div class="carousel-item text-center" data-bs-interval="2000">
      <img src="/storage/img/placeholder600x400.png" class="" alt="...">
      <br>
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>

    <div class="carousel-item text-center">
      <img src="/storage/img/placeholder600x400.png" class="" alt="...">
      <br>
      <div class="carousel-caption d-none d-md-block" style="color:white">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="icon-prev"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="icon-next"></span>
  </a>
</div>
</div>

    
    
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