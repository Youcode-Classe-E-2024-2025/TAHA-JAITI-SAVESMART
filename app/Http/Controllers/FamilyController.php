<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use Illuminate\Support\Str;

class FamilyController extends Controller
{
    public function index(){

        return view("family.index");
    }

    public function store(Request $request){
        $request->validate(['name' => 'required|min:3']);

        $family = Family::create([
            'name'=> $request->name,
            'code' => Str::random(6),
        ]);

        $user = $request->user();

        if ($family && $user){
            $user->family_id = $family->id;
            $user->role = 'head';
            $user->save();

            return to_route('family.index')->with('success', 'Family created successfully');
        }


        return to_route('family.index')->with('error','Failed creating family, try again');
    }
}
