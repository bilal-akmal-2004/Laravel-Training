<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Http\Resources\VenueResource;
use App\Services\Contracts\VenueServiceContract;
use App\Http\Requests\IndexVenueRequest;
use Illuminate\Http\JsonResponse;

class VenueController extends Controller
{
    public function __construct(
    private VenueServiceContract $venueService
) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexVenueRequest $request): JsonResponse
    {
        return VenueResource::collection($this->venueService->paginate(
            $request->input('per_page',20)
        ))->response();
    }

    public function store(StoreVenueRequest $request): JsonResponse
    {
        $venue = $this->venueService->create($request->validated());

        return (new VenueResource($venue))->response()->setStatusCode(201);
    }

    public function show(Venue $venue): JsonResponse
    {
        return (new VenueResource($venue))->response();
    }

    public function update(UpdateVenueRequest $request, Venue $venue): JsonResponse
    {
        $venue = $this->venueService->update(
            $venue,
            $request->validated()
        );

        return (new VenueResource($venue))->response();
    }

    public function destroy(Venue $venue): JsonResponse
    {
        $this->venueService->delete($venue);

        return response()->json([
            'message' => 'Venue deleted successfully'
        ]);
    }
}
