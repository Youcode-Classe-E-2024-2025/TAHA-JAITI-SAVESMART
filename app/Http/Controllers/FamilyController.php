<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use Illuminate\Support\Str;
use App\Models\User;

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

    public function join(Request $request){
        $user = $request->user();
        $family = Family::where('code', '=', $request->code)->first();

        if ($family && $user){
            $user->family_id = $family->id;
            $user->role = 'member';
            $user->save();
            return to_route('family.index')->with('success','Joined family!');
        }

        return to_route('family.index')->with('error','Invalid family code');
    }

    public function destroy(Request $request){
        $user = $request->user();

        $family = Family::where('id', '=', $user->family_id)->first();

        if ($family && $user->role === 'head'){
            $family->delete();
            $user->role = 'member';
            $user->family_id = null;
            $user->save();
            return to_route('family.index')->with('success','Family deleted successfully');
        }

        return to_route('family.index')->with('error','You are not authorized to delete this family');
    }

    public function leave(Request $request){
        $user = $request->user();

        $family = Family::where('id', '=', $user->family_id)->first();

        if ($family && $user->role === 'member'){
            $user->family_id = null;
            $user->save();
            return to_route('family.index')->with('success','Left family!');
        }

        return to_route('family.index')->with('error','You are not authorized to leave this family');
    }

    public function remove(Request $request, User $user){
        $head = $request->user();

        if ($head->role === 'head' && $user->role === 'member'){
            $user->family_id = null;
            $user->save();
            return to_route('family.index')->with('success','Removed member from family');
        }

        return to_route('family.index')->with('error','You are not authorized to remove this member');
    }
}
