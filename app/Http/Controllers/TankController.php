<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tank;

class TankController extends Controller
{
    public function index()
    {
        $tanks = Tank::all();
        return view('main.index', compact('tanks'));
    }
    public function show($id)
    {
        $tank = Tank::findOrFail($id);

        return view('main.tank-details', compact('tank'));
    }
}
