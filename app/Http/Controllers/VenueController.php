<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Http\Resources\VenueResource;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
        'success' => true,
        'data' => VenueResource::collection(Venue::all())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVenueRequest $request)
    {
        $venue = Venue::create($request->validated());

        return response()->json([
        'success' => true,
        'message' => 'Venue created successfully',
        'data' => new VenueResource($venue)
         ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venue = Venue::find($id);

        if(!$venue){
            return response()->json([
                'success' => false,
                'message' => 'Venue not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new VenueResource($venue)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVenueRequest $request, $id)
    {
        $venue = Venue::find($id);

        if(!$venue){
            return response()->json([
              'success' => false,
              'message' => 'Venue not found'
            ], 404);
        }

        $venue->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Venue updated successfully',
            'data' => new VenueResource($venue)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venue = Venue::find($id);

        if(!$venue){
            return response()->json([
                'success' => false,
                'message' => 'Venue not found'
            ], 404);
        }

        $venue->delete();

        return response()->json([
            'success' => true,
            'message' => 'Venue deleted successfully'
        ], 200);
    }
}
