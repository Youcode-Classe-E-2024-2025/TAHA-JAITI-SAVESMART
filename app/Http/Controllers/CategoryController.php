<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $query = Category::query();

        if ($user->family_id) {
            $query->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('family_id', $user->family_id);
            });
        } else {
            $query->where('user_id', $user->id);
        }

        $categories = $query->paginate(6);

        return view("category.index", compact("categories"));
    }

    public function create()
    {
        return view("category.create");
    }

    public function store(Request $request)
    {

        $request->validate([
            "name" => "required|string|min:3|max:255",
        ]);

        $category = Category::create([
            "name" => $request->name,
            'user_id' => Auth::user()->id,
            'family_id' => $request->type === 'personal' ? null : Auth::user()->family_id,
        ]);

        if ($category) {
            return to_route('category.index')->with('success', 'Category created successfully');
        }

        return back()->with('error', 'Category could not be created');
    }

    public function destroy(Category $category)
    {
        $user = Auth::user();

        if ($category->user_id != $user->id || $category->family_id != $user->family_id) {
            return back()->with('error', 'You are not authorized to delete this category');
        }

        $category->delete();
        return to_route('category.index')->with('success', 'Category deleted successfully');
    }

    public function edit(Category $category){
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category){
        $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);


        $category = $category->update([
            'name' => $request->name,
            'user_id'=> Auth::user()->id,
            'family_id' => $request->type === 'personal' ? null : Auth::user()->family_id,
        ]);


        if ($category) {
            return to_route('category.index')->with('success','Category updated');
        }

        return back()->with('error', 'Failed to update category');
    }
}