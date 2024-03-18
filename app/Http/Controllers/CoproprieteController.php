<?php

namespace App\Http\Controllers;

use App\Models\copropriete;
use Illuminate\Http\Request;
use Validator;
class CoproprieteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comprop = copropriete::all();
        return response()->json($comprop);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'immobilier_id' => 'required|exists:immobiliers,id',
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }
        $copropData = $request->all();
        $copropData['immobilier_id'] = $request->input('immobilier_id');//ajouter la valeur de id dans formulaire pour que cette valeur passe dans la requete
        copropriete::create($copropData);
        //Event::create($request->all());
        return response()->json(['message' => 'copropriété added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $copropData = copropriete::findOrFail($id);
        return response()->json($copropData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        copropriete::findOrFail($id)->update($request->all());
        return response()->json(['message' => 'copropriété Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        copropriete::findOrFail($id)->delete();
        return response()->json(['message' => 'copropriété Deleted Successfully']);
    }
}
