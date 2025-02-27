<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(10);

        return view("category.index",compact("categories"));
    }

    public function create(){
        return view("category.create");
    }

    public function store(Request $request){

        $request->validate([
            "name"=> "required|string|min:3|max:255",
        ]);

        $category = Category::create([
            "name"=> $request->name,
            'user_id'=> Auth::user()->id,
            'family_id' => $request->type === 'personal' ? null : Auth::user()->family_id,
        ]);

        if ($category){
            return to_route('category.index')->with('success','Category created successfully');
        }

        return back()->with('error','Category could not be created');
    }

    public function destroy(Category $category){
        $category->delete();

        return to_route('category.index')->with('success','Category deleted successfully');
    }
}
