<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Storage;

use App\Models\article;
use App\User;



class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        
        return view('articleIndex', ['articles' => $articles]);
    }

    //set publish date
    public function publish()
    {

    }


    public function hide($isHidden)
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createarticle');
    }



    public function sanitize($input)
    {
        try 
        {
            $quill = new \DBlackborough\Quill\Render($input);
            $result = $quill->render();
            return ($result);
        } catch (Exception $e) 
        {
            dd($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {             
        $title = $request->input("article_title");

        $post = new article();
        $post->title= $title;
        $post->user_id = 1;
        $slug = Str::slug($title, '-');
        $post->slug = $slug;

        $art = $request->input('article');
        
        
        $result = self::sanitize($art);

        //dd($result);

        //turn images from base64

        //Load the HTML string into our DOMDocument object.
        $htmlDom = new \DOMDocument();
        @$htmlDom->loadHTML($result);

        //Extract all img elements / tags from the HTML.
        $imageTags = $htmlDom->getElementsByTagName('img');
        //Create an array to add extracted images to.
        $extractedImages = array();

        //Loop through the image tags that DOMDocument found.
        $img_id = 0;
        foreach($imageTags as $imageTag)
        {
            //constants as far as this function is concerned
            $imgname = $slug . "_" .$img_id .".jpg";
            $imgdir = "/storage/images/";


            //create the image from the image tag
            $imgSrc = $imageTag->getAttribute('src');
            $img = self::base64_to_img($imgSrc);

            //store the image as a file
            self::storeImage($img, $imgdir.$imgname);

            //change the image to a link to the new file
            $imageTag->setAttribute('src', "/storage/".$imgdir.$imgname );

            //clean up
            $img_id++;
            
        };

        $post->article= $htmlDom->saveHTML();
        $post->save();    

        
        
        redirect("/articles/$post->id")->send();
    }



    //the base64string is split between metadata and the actual data
    function base64_to_img($base64_string) { 
    
        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );   
        $bin = base64_decode($data[1]);               
        return $bin;
       
        
    }


    public function storeImage($image, $name)
    {
        Storage::disk('public')->put($name, $image, 'public');
            
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(article $article)
    {
       $u = $article->user;       
        
       return view('article' , ['article' => $article]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(article $article)
    {
        //
    }

    public function image($image)
    {
        return true;
    }
}
