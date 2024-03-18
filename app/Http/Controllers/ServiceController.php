<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return response()->json($services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'copropriete_id' => 'required|exists:coproprietes,id',
            'name' => 'required',
            'responsable_name' => 'required',
            'responsable_contact' => 'required|unique:services|size:8|regex:/^[0-9]{8}$/',
            'frequence' => 'required',
            'type' => 'required',
            'prix' => 'required',
            'start_date' => 'required|date|date_format:Y-m-d',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }
        $ServiceData = $request->all();
        $ServiceData['copropriete_id'] = $request->input('copropriete_id');//ajouter la valeur de id dans formulaire pour que cette valeur passe dans la requete
        Service::create($ServiceData);
        //Immobilier::create($request->all());
        return response()->json(['message' => 'Service added successfully'],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Service::findOrFail($id)->update($request->all());
        return response()->json(['message' => 'Service Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Service::findOrFail($id)->delete();
        return response()->json(['message' => 'Service Deleted Successfully']);
    }
}
