

<script src="//cdn.quilljs.com/latest/quill.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
form {background-color: red;}
h1   {color: blue;}
p    {color: white;}
</style>



<script>

var QuillDeltaToHtmlConverter = ('asset{{('js/QuillDeltaToHtmlConverter.bundle')}}').QuillDeltaToHtmlConverter;



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

