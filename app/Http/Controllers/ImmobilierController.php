<?php
namespace App\Http\Controllers;
use App\Models\Immobilier;
use Illuminate\Http\Request;
use Validator;
class ImmobilierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $immobiliers = Immobilier::all();
        return response()->json($immobiliers);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'syndicat_id'=> 'required|exists:syndicats,id',
            'city_id'=> 'required|exists:location_cities,id',
            'name' => 'required|unique:immobiliers',
            'address' => 'required',
            'apartements_number' => 'required',
            'floors_number' => 'required',
            'description' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }
        $immobilierData = $request->all();
        $immobilierData['syndicat_id'] = $request->input('syndicat_id');//ajouter la valeur de id dans formulaire pour que cette valeur passe dans la requete
        Immobilier::create($immobilierData);
        //Immobilier::create($request->all());
        return response()->json(['message' => 'Immobilier added successfully']);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $immobilier = Immobilier::findOrFail($id);
        return response()->json($immobilier);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'unique:immobiliers',
        ]);
        Immobilier::findOrFail($id)->update($request->all());
        return response()->json(['message' => 'Immobilier Updated Successfully']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Immobilier::findOrFail($id)->delete();
        return response()->json(['message' => 'Immobilier Deleted Successfully']);
    }
}