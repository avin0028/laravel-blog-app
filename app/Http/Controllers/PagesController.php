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
    
}
