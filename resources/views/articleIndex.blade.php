@extends('layout')

@section('content')

   @foreach($articles as $article)
   <div>
      <div>
            <header>
            <h1 >{{$article->title}}</h1> 
            <p>
            <img src ="/storage/img/jonny.jpg" width="64" height="64"> by {{$article->user->username}}</p>    
            </header>
      </div>
      <p>
         {!!$article->article!!}
      </p>
   </div>

   @endforeach
    
@endsection