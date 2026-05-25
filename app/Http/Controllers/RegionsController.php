<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegionRequest;
use App\Services\RegionService;

class RegionsController extends Controller
{
    protected $regionService;

    public function __construct(RegionService $regionService)
    {
        $this->regionService = $regionService;
    }

    public function store(RegionRequest $request)
    {
        $validated = $request->validated();

        $region = $this->regionService->createRegion($validated);

        return response()->json([
            'message' => 'Region created successfully',
            'data' => $region
        ], 201);
    }

    public function destroy($id)
    {
        $deleted = $this->regionService->deleteRegion($id);

        return response()->json([
            'message' => $deleted ? 'Region deleted successfully' : 'Region not found'
        ], $deleted ? 200 : 404);
    }
}
