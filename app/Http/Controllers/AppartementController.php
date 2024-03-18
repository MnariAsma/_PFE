<?php

namespace App\Http\Controllers;

use App\Models\Appartement;
use Illuminate\Http\Request;
use Validator;
class AppartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appartements = Appartement::all();
        return response()->json($appartements);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id'=> 'exists:users,id',
            'immobilier_id'=> 'required|exists:immobiliers,id',
            'number' => 'required|unique:appartements',
            'floor' => 'required',
            'surface' => 'required',
            'nb_rooms' => 'required',
            'description'=> 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }
        $appartementData = $request->all();
        $appartementData['immobilier_id'] = $request->input('immobilier_id');//ajouter la valeur de id dans formulaire pour que cette valeur passe dans la requete
        Appartement::create($appartementData);
        //Appartement::create($request->all());
        return response()->json(['message' => 'Apartement added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appartement = Appartement::findOrFail($id);
        return response()->json($appartement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'number' => 'unique:appartements',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }
        Appartement::findOrFail($id)->update($request->all());
        return response()->json(['message' => 'Apartement Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Appartement::findOrFail($id)->delete();
        return response()->json(['message' => 'Apartement Deleted Successfully']);
    } 
}
