<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class SimulationController extends Controller
{
    public function index()
    {
        // Includes the components
        $categories = Category::all();

        $effects = [
//            'Leefbaarheid'
        ];


        return view('simulation', compact('categories', 'effects'));
    }
}
