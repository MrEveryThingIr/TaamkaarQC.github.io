<?php

namespace App\Http\Controllers;

use App\Models\Orderer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orderers = Orderer::all();
        return view('dashboard', compact('orderers'));
    }
}
