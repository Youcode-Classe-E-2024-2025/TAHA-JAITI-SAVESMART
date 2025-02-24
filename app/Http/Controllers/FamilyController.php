<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FamilyController extends Controller
{
    //CREATE VIEW

    public function create() {
        return view('family.create');
    }

    public function code(){
        return view('family.code');
    }
}
