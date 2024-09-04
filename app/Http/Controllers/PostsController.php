<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 
use function Pest\Laravel\json;

class PostsController extends Controller
{
    public function show(){
        $categories = Category::all();
        
        return view('dashboard.newpost', compact('categories'));
    }
    public function showpost(string $url){
        $post = Post::where('url',$url)->get();
        return view('ShowPost',compact('post'));
    }
    
    public function store(Request $request) : RedirectResponse
    {


        $request->validate([
            'title' => ['required', 'string', 'max:25'],
            'content' => ['required', 'string', 'max:255'],
            'tags' => ['required'],
            'url'=> ['required','max:20'],
            'category'=>['required','integer'],
            'status'=>['required','integer']
           
        ]);
        // dd($request->all());
        $post = new Post();
        $post->author_id = Auth::id();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category;
        $post->tags = $request->tags;
        $post->status = $request->status;
        $post->url = $request->url;
        $post->save();
        return redirect()->route('showpost', ['url' => $request->url]);

    }

    public function delete(Request $request) : RedirectResponse
    {
       Post::where('url',$request->url)->delete();
       return redirect()->route('home');

    }


}
