<?php
namespace App\Http\Controllers;
// app/Http/Controllers/DashboardController.php
use App\Models\Orderer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Adjust nested structure to match actual model relationships
        $orderers = Orderer::with([
            'projects.drawingParts.samples.sampleMeasurements.contradiction', // Use singular 'contradiction' based on SampleMeasurement relationship
            'projects.drawingParts.dimensions',
        ])->get();

        // Pass data to the dashboard view
        return view('dashboard', compact('orderers'));
    }
}
