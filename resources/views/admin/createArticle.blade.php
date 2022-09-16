@extends('layout')

@section('header')

@endsection

@section('content')






<div id="form-container" class="container">
  <form id="article_form" method = "POST" action="/articles" onsubmit="submitChange()">
    @csrf
    <div class ="row"> <div class="col-xs-8"><div class="form-group">
      <label for="Article_Title">Title</label>
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
<script> 

var quill = new Quill('#articletext', {
  modules: {
    toolbar: [
      ['image'],
      
    ]
  },
  placeholder: 'Compose an epic...',
  theme: 'snow',
  handlers: {
            image: this.imageHandler
          },
});



var form = document.querySelector('form');

var articleoutput = document.querySelector('input[name=article]');

function submitChange() 
{
  
  articleoutput.value = JSON.stringify(quill.getContents());
  console.log(articleoutput);
  alert('Open the console to see the submit data!')

  return false;
  
 
}

function imageHandler() {
    var range = this.quill.getSelection();
    var value = prompt('please copy paste the image url here.');
    if(value){
        this.quill.insertEmbed(10, 'image', 'https://quilljs.com/images/cloud.png');
    }
}
</script>




@endsection

@section('footer')

@endsection