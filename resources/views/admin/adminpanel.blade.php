@extends('admin.layout')

@section('header')

@endsection

@section('content')

  <div>
    
    <form>
    Articles:
    <input type = "submit" value="submit">
    <table class="table"> 
    <tr>
      <th>Article</th>
      <th>Author</th>
      <th>Is Featured</th>
    </tr>

    @foreach($articles as $article)
    <tr>
      <th>{{$article->title}}</th>
      <th>{{$article->user->username}}</th>
      <th><input type="checkbox">{{$article->featured}}</input></th>
    </tr>
    @endforeach
    </form>
  </div>
    
@endsection