<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

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
        'data' => Venue::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venue = Venue::create([
        'name' => $request->name,
        'address' => $request->address,
        'capacity' => $request->capacity,
        ]);

        return response()->json([
        'success' => true,
        'message' => 'Venue created successfully',
        'data' => $venue
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
            'data' => $venue
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $venue = Venue::find($id);

        if(!$venue){
            return response()->json([
              'success' => false,
              'message' => 'Venue not found'
            ], 404);
        }

        $venue->update([
            'name' => $request->name,
            'address' => $request->address,
            'capacity' => $request->capacity,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Venue updated successfully',
            'data' => $venue
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
