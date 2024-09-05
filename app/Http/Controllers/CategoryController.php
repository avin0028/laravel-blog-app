<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class CategoryController extends Controller
{

 public function show(Request $request){
    return view('dashboard.managecategory');
 }
 public function action(Request $request):RedirectResponse
 {
   if($request->delete){

      Category::where('name',$request->delete)->delete();
   }else{
   $category = new Category();
   $category->name = $request->add;
   $category->save();
   }
   return redirect()->route('managecats');
 }

}
