<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        $request->validate(['name' => 'required|string|max:255|unique:categories']);

        Category::create([
            'name' => $request->name,
            'family_id' => $request->user()->family_id,
            'user_id' => $request->user()->id,
        ]);

        return to_route('dashboard');
    }
}
