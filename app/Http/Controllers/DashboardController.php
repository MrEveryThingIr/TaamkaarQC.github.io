<?php
namespace App\Http\Controllers;
// app/Http/Controllers/DashboardController.php
use App\Models\Orderer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Load all related models in a nested structure
        $orderers = Orderer::with([
            'projects.drawingParts.dimensions.samples.sampleMeasurements.contradictions'
        ])->get();

        // Pass the data to the dashboard view
        return view('dashboard', compact('orderers'));

    }
}
