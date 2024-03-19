<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use Illuminate\Http\Request;
use Validator;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depense = Depense::all();
        return response()->json($depense);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'copropriete_id' => 'required|exists:coproprietes,id',
            'description' => 'required',
            'price' => 'required',
            'date' => 'required|date|date_format:Y-m-d',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }
        // $depense = $request->all();
        // $depense['copropriete_id'] = $request->input('copropriete_id');//ajouter la valeur de id dans formulaire pour que cette valeur passe dans la requete
        // Depense::create($depense);
        Depense::create($request->all());
        return response()->json(['message' => 'Depense added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $depense = Depense::findOrFail($id);
        return response()->json($depense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Depense::findOrFail($id)->update($request->all());
        return response()->json(['message' => 'Depense Updated Successfully']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Depense::findOrFail($id)->delete();
        return response()->json(['message' => 'depense Deleted Successfully']);
    }
}
