<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\json;

class PostsController extends Controller
{
    public function show(){
        $categories = Category::all();
        
        return view('dashboard.newpost', compact('categories'));
    }
    
    public function store(Request $request){


        $request->validate([
            'title' => ['required', 'string', 'max:25'],
            'content' => ['required', 'string', 'max:255'],
            'tags' => ['required'],
           
        ]);

        $post = Post::create(
            [
                'title' => $request->title,
                'content'=> $request->content,
                'tags'=> $request->tags,
                'author'=> $request->Auth::id(),
                'category'=> $request->category,
                'status'=> $request->status,
                'url' => $request->url
            ]
            );
    }
}
