<?php

namespace App\Http\Controllers;

use App\Models\Category;

class SimulationController extends Controller
{
    public function index()
    {
        // Includes the components
        $categories = Category::all();

        $effects = [
            'Veiligheid',
            'Recreatie',
            'Milieukwaliteit',
            'Voorzieningen',
            'Mobiliteit',
        ];


        return view('simulation', compact('categories', 'effects'));
    }
}
