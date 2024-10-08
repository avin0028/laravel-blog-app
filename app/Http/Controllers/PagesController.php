<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class PagesController extends Controller{

    public function show(Request $request){
        return view('dashboard.newpage');
    }
    public function store(Request $request) :RedirectResponse{
        $request->validate([
            'title'=> ['required','max:25','string'],
            'content'=> ['string','required','max:256'],
            'url'=>['required','min:3','string']
        ]);
        $page = new Page();
        $page->title = $request->title;
        $page->content = $request->content;
        $page->status = $request->status;
        $page->author = Auth::id();
        $page->url = $request->url;
        $page->save();
        return redirect()->route('showpage', ['url' => $request->url]);

    }

    public function delete(Request $request) : RedirectResponse
    {
       Page::where('url',$request->url)->delete();
       return redirect()->route('home');
    }
    public function showpages(Request $request){
        $posts = Page::where('status','1')->get();
        return view('ShowPosts',compact('posts'));
    }
    public function showpage(String $url){
        $page = Page::where('url',$url)->get();
        return view('ShowPage',compact('page'));
    }
    public function editpage(Request $request){
        $url = $request->query('url');
        if(!$url){
            $pages = Page::all();

            return view('dashboard.editpage',compact('pages'));
        }else{

            $page = Page::where('url',$url)->get();
            return view('dashboard.editpage',compact('page'));
        }
    }
    public function editthepage(Request $request){
        $request->validate([
            'title'=> ['required','max:25','string'],
            'content'=>['required','max:256','string']
        ]);

        Page::where('url',$request->url)->update([
            'title' => $request->title,
            'content'=> $request->content,
            'status'=> $request->status
        ]);
        return redirect()->route('showpage', ['url' => $request->url]);
    }
}
