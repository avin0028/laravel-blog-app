<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function show(){
        $categories = Category::all();
        
        return view('dashboard.newpost', compact('categories'));
    }
    public function showpost(string $url){
        $post = Post::where('url',$url)->get();
        //prevent showing replies as comments by adding whereNull()
        $comments = Comment::where('status',1)->whereNull('parent_id')->get();
        return view('ShowPost',compact('post','comments'));
    }

    public function editpost(Request $request){
        $url = $request->query('url');
        if(!$url){

            return view('dashboard.editpost');
        }
        $post = Post::where('url',$url)->get();
        // dd($post[0]);
        return view('dashboard.editpost',compact('post'));

    }

    public function editthepost(Request $request):RedirectResponse{
     Post::where('url',$request->url)->update([
            'title' => $request->title,
            'content'=> $request->content,
            'tags'=> $request->tags,
            'status'=> $request->status
        ]);
        return redirect()->route('showpost', ['url' => $request->url]);
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
    public function showposts(Request $request){
        $posts = Post::where('status','1')->get();
        return view('ShowPosts',compact('posts'));

    }

    public function delete(Request $request) : RedirectResponse
    {
       Post::where('url',$request->url)->delete();
       return redirect()->route('showposts');

    }


}
