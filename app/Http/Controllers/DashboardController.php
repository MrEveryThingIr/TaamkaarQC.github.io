<?php

namespace App\Http\Controllers;

use App\Models\Orderer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
         // Load all orderers with their projects
         $orderers = Orderer::with('projects')->get();
        return view('dashboard', compact('orderers'));
    }
}
