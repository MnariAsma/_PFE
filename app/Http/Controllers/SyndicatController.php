<?php

namespace App\Http\Controllers;

use App\Models\Syndicat;
use Illuminate\Http\Request;
use Validator;
class SyndicatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $syndicat = Syndicat::all();
        return response()->json($syndicat);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'super_admin_id'=> 'required|exists:users,id',
            'cities_id'=> 'required|exists:location_cities,id',
            'name' => 'required|unique:syndicats',
            'phone_number' => 'required|unique:syndicats',
            'email' => 'required|unique:syndicats',
            'address' => 'required|max:255',
            'password' => 'required|min:8',
        ]);
        
        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }
        Syndicat::create($request->all());
        return response()->json(['message' => 'Syndicat Created Successfully']);

        // $syndicat = new Syndicat();
        // $syndicat->nom = 'Nom du syndicat';
        // $syndicat->save();
        // $qrCode = new QrCode('http://votre-domaine.com/syndicat/' . $syndicat->id);
        // $qrCode->setSize(300);
        // $syndicat->qrcode = $qrCode->writeString();
        // $syndicat->save();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $syndicat = Syndicat::findOrFail($id);
        return response()->json($syndicat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'cities_id'=> 'exists:location_cities,id',
            'name' => 'unique:syndicats',
            'phone_number' => 'unique:syndicats',
            'email' => 'unique:syndicats',
            'address' => 'max:255',
            'password' => 'min:8',
        ]);
        Syndicat::findOrFail($id)->update($request->all());
        return response()->json(['message' => 'Syndicat Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Syndicat::findOrFail($id)->delete();
        return response()->json(['message' => 'Syndicat Deleted- Successfully']);
    }
}
