<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Illuminate\Http\Request;
use Validator;

class ContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contribution = Contribution::all();
        return response()->json($contribution);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'immobilier_id' => 'required|exists:immobiliers,id',
            'contribution' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }
        $contribution = $request->all();
        $contribution['immobilier_id'] = $request->input('immobilier_id');//ajouter la valeur de id dans formulaire pour que cette valeur passe dans la requete
        Contribution::create($contribution);
        // Contribution::create($request->all());
        return response()->json(['message' => 'contribution added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contribution = Contribution::findOrFail($id);
        return response()->json($contribution);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Contribution::findOrFail($id)->update($request->all());
        return response()->json(['message' => 'Contribution Updated Successfully']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Contribution::findOrFail($id)->delete();
        return response()->json(['message' => 'Contribution Deleted Successfully']);
    }
}
