<?php

namespace App\Http\Controllers\Api;
use App\Models\Lycee;
use App\Models\Commune;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LyceeController extends Controller
{
    public function getLycee()
    {
        $lycee = Lycee::all();
        $data = [
            'status' => 200,
            'commune' => $lycee
        ];
        if($lycee->count()>0){
            return response()->json($data, 200);
        }else{
            return response()->json(['status' => 404, 'message' => 'pas Lycée trouver'], 404);
        } 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getLyceeByCodes($codes)
    {
        $lyc = Lycee::where('code_lyc', $codes)->first();
        if($lyc){
            return response()->json([
                'status' => 200,
                'lycee' =>  $lyc
            ], 200);            
        }else{
            return response()->json([
                'status' => 404,
                'message' => "aucune de commune trouvé!"
            ], 404);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createLycee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:191',
            'adresse' => 'required|string|max:191',
            'code_lyc' => 'required|string|max:4|unique:lycee,code_lyc',
            'commune_id' => 'required|integer|max:10',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);

        }else{
            $com = Lycee::create([
                'nom' => $request->nom,
                'adresse' => $request->adresse,
                'code_lyc' =>strtoupper($request->code_lyc),
                'commune_id' => $request->commune_id
            ]);

            if($com){
                return response()->json([
                    'status' => 200,
                    'message' => "Lycée crée avec success!"
                ], 200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "Quelques chose s'est passé!"
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function getLyceesByCommuneId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'commune_id' => 'required|integer|exists:communes,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        }
    
        $communeId = $request->input('commune_id');
    
        $lycees = Lycee::where('commune_id', $communeId)->get();
    
        $data = [
            'status' => 200,
            'lycees' => $lycees,
        ];
    
        if ($lycees->count() > 0) {
            return response()->json($data, 200);
        } else {
            return response()->json(['status' => 404, 'message' => 'Aucune Lycée trouvé pour cet commune'], 404);
        }
    }

  
    /**
     * Update the specified resource in storage.
     */
public function updateLyceeByCodes(string $codes, Request $request)
{
    $codes = strtoupper($codes);
    $lycee = Lycee::where('code_lyc', $codes)->first();
    

    if ($lycee) {
        // Effectuer les modifications sur le village en fonction des données reçues dans la requête
        $lycee->update([
            'nom' => $request->input('nom'), 
            'code_lyc' => $request->input('code_lyc'),
            // Ajoutez d'autres champs à mettre à jour ici...
        ]);
 
        return response()->json([
            'status' => 200,
            'message' => "Lycée modifiée avec succès!",
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
            'message' => "Lycée non trouvée!"
        ], 404);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroyLycee(string $codes)
     {
        $lycees = Lycee::where('code_lyc', $codes)->first();

        if($lycees){
            $lycees->delete();
            return response()->json([
                'status' => 200,
                'message' => "Lycée  supprimée avec success!"
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Lycée non trouvé!"
            ], 404);
        }
    }
}
