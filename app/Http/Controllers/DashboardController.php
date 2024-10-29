<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Orderer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orderers = Orderer::with([
            'projects.drawingParts.samples.sampleMeasurements.contradiction',
            'projects.drawingParts.dimensions',
        ])->get();

        return view('dashboard', compact('orderers'));
    }

    public function search(Request $request)
    {
        return $this->loadDashboardData($request);
    }

    private function loadDashboardData(Request $request)
    {
        $searchCriteria = [];
        foreach ($request->input('fields', []) as $field => $enabled) {
            if ($enabled && $request->filled($field)) {
                $searchCriteria[$field] = $request->input($field);
            }
        }

        $orderers = Orderer::with([
            'projects' => function ($projectQuery) use ($searchCriteria) {
                if (!empty($searchCriteria)) {
                    $projectQuery->searchBy($searchCriteria);
                }
            },
            'projects.drawingParts.samples.sampleMeasurements.contradiction',
            'projects.drawingParts.dimensions',
        ])->get();

        $activeSections = $this->determineActiveSections($orderers, $searchCriteria);

        return view('dashboard', compact('orderers', 'activeSections'));
    }

    private function determineActiveSections($orderers, $searchCriteria)
    {
        $activeSections = ['overview'];
        foreach ($orderers as $orderer) {
            if (isset($searchCriteria['orderer_name']) && str_contains($orderer->orderer_name, $searchCriteria['orderer_name'])) {
                $activeSections[] = 'orderer_' . $orderer->id;
            }
            foreach ($orderer->projects as $project) {
                if (isset($searchCriteria['project_title']) && str_contains($project->project_title, $searchCriteria['project_title'])) {
                    $activeSections[] = 'project_' . $project->id;
                }
                foreach ($project->drawingParts as $drawingPart) {
                    if (isset($searchCriteria['part_name']) && str_contains($drawingPart->part_name, $searchCriteria['part_name'])) {
                        $activeSections[] = 'drawingPart_' . $drawingPart->id;
                    }
                }
            }
        }
        return $activeSections;
    }
}
