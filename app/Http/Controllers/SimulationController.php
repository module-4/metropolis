<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulationController extends Controller
{
    public function index()
    {
        $effects = [
            'Leefbaarheid'
        ];
        $componentGroups = [
            [
                'category' => 'Groen',
                'components' => [
                    'Park (klein)',
                    'Park (groot)',
                    'Bos'
                ]
            ],
            [
                'category' => 'Industrieel',
                'components' => [
                    'Appartementencomplex',
                    'Fabriek',
                    'Winkelcentrum'
                ]
            ]
        ];
        return view('simulation', compact('componentGroups', 'effects'));
    }
}
