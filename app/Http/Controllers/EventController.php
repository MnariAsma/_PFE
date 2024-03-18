<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'immobilier_id' => 'required|exists:immobiliers,id',
            'event_name' => 'required',
            'event_description' => 'required',
            'event_date' => 'required|date|date_format:Y-m-d',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }
        $eventsData = $request->all();
        $eventsData['immobilier_id'] = $request->input('immobilier_id');//ajouter la valeur de id dans formulaire pour que cette valeur passe dans la requete
        Event::create($eventsData);
        //Event::create($request->all());
        return response()->json(['message' => 'event added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Event::findOrFail($id)->update($request->all());
        return response()->json(['message' => 'event Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Event::findOrFail($id)->delete();
        return response()->json(['message' => 'event Deleted Successfully']);
    }
}