<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FamilyController extends Controller
{
    //CREATE VIEW

    public function create() {
        return view('family.create');
    }

    public function code(Family $family){
        return view('family.code', ['family' => $family]);
    }

    public function store(request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $family = Family::create([
            'name' => $request->name,
            'owner_id' => $request->user()->id,
            'code' => strtoupper(Str::random(6))
        ]);

        if ($family){
            $user = $request->user();
            $user->family_id = $family->id;
            $user->save();
        }

        return to_route('family.code', $family);
    }
}
