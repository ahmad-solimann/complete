<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function getCategory($id){
        $local = \Illuminate\Support\Facades\App::currentLocale();
//        $categories = Category::where('parent_id',$id)->with(['categoryDetails','styles'])->get();
        $categories = Category::join('category_details as C','C.id','=','categories.category_details_id')->join('category_details_translations as S','S.category_details_id','=','C.id')
            ->where('S.locale','=',$local)->where('categories.parent_id',$id)->get();
        return response()->json($categories);
    }
    public function parent(){
        $local = \Illuminate\Support\Facades\App::currentLocale();
//        $categories = Category::where('parent_id',null)->with('categoryDetails')->get();
        $categories = Category::join('category_details as C','C.id','=','categories.category_details_id')->join('category_details_translations as S','S.category_details_id','=','C.id')
            ->where('S.locale','=',$local)->where('categories.parent_id',null)
            ->get();
        return response()->json($categories);
    }
    public function grandparent($id){
        $category = Category::find($id);
        $local = \Illuminate\Support\Facades\App::currentLocale();
//        $categories = Category::where('parent_id',$category->parent_id)->get();
        $categories =Category::join('category_details as C','C.id','=','categories.category_details_id')->join('category_details_translations as S','S.category_details_id','=','C.id')
            ->where('S.locale','=',$local)->where('categories.parent_id',$category->parent_id)
            ->get();
        return response()->json($categories);
    }
    public function styles($id){
        $category_styles = Category::find($id);
        return response()->json($category_styles->styles);
    }

    public function isAuth(){
        if(Auth::check()){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }

}