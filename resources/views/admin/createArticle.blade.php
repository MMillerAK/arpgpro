@extends('admin.layout')

@section('header')
<h1 class="h2">Create Article</h1>
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

<script src="//cdn.quilljs.com/latest/quill.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">




<script>

var QuillDeltaToHtmlConverter = ('asset{{('js/QuillDeltaToHtmlConverter.bundle')}}').QuillDeltaToHtmlConverter;


var quill = new Quill('#articletext', {
  modules: {
    toolbar: [
      ['image'],
      ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  ['blockquote', 'code-block'],

  [{ 'header': 1 }, { 'header': 2 }],               // custom button values
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  [{ 'direction': 'rtl' }],                         // text direction

  [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  [{ 'font': [] }],
  [{ 'align': [] }],

  ['clean']                                         // remove formatting button
      
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