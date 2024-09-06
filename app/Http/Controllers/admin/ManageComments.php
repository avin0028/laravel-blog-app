<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ManageComments extends Controller
{
    public function show(Request $request){
        $comments = Comment::with('user')->where('status', 0)->get();
        return view('admin.managecomments',compact('comments'));
    }
    public function action(Request $request, Comment $comment) :RedirectResponse{

        if($request->action == 'confirm'){
            $comment->status = 1;
            $comment->save();
            return redirect()->route('managecomments')->with('success', 'Comment confirmed successfully.');

        }elseif($request->action == "delete"){
            $comment->delete();
            return redirect()->route('managecomments')->with('success', 'Comment deleted successfully.');


        }else{

            return redirect()->back();
        }
        

    }
  
}
