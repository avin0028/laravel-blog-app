<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    
    public function store(Request $request){
    
        $request->validate([
            'content' => ['required','max:128'],
            'post_id' => ['required','exists:posts,id'],
            'parent_id' => ['nullable','exists:comments,id'],
        ]);
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post_id;
        $comment->parent_id = $request->parent_id;
        $comment->status = 0;
        $comment->save();

        return redirect()->back();

    }


}
