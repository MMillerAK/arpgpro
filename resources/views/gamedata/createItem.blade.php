@extends('admin.layout')

@section('header')
<h1 class="h2">Create Item</h1>
@endsection

@section('content')

<div id="form-container" class="container">
  <form id="item_form" method = "POST" action="/data/item" onsubmit="submitChange()">
    @csrf
    <div class ="row"> <div class="col-xs-8"><div class="form-group">
      <label for="Article_Title">Item Name</label>
      <input class="form-control" name="article_title" type="text" value="make a title">
    </div></div></div>
          
    <div class= "row"><div class="col-xs-8"><div class="form-group">   
      <label for="articletext">Article</label>
      <div id= "articletext" name="articletext" form="article_form"></div>
      </div></div></div>
      <input name="article" id= "article" type="hidden">
    

   
    <div class= "row"><div class="col-xs-8"><div class="form-group"> 
      <button class="btn btn-primary" type="submit">Save Profile</button>
    </div></div></div>
  </form>
</div>

<script src="//cdn.quilljs.com/latest/quill.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

@endsection