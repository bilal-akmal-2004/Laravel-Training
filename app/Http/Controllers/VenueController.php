<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Http\Resources\VenueResource;
use App\Services\Contracts\VenueServiceContract;
use App\Http\Requests\IndexVenueRequest;

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
    public function index(IndexVenueRequest $request)
    {
        return VenueResource::collection($this->venueService->paginate(
            $request->input('per_page',20)
        ))->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVenueRequest $request)
    {
        $venue = $this->venueService->create($request->validated());

        return (new VenueResource($venue))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        return (new VenueResource($venue))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        $venue = $this->venueService->update(
            $venue,
            $request->validated()
        );

        return (new VenueResource($venue))->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {
        $this->venueService->delete($venue);

        return response()->json([
            'message' => 'Venue deleted successfully'
        ]);
    }
}
