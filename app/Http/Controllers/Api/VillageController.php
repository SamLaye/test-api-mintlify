<?php

namespace App\Http\Controllers\Api;

use App\Models\Village; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Arrondissement;
use Illuminate\Support\Facades\Validator;

class VillageController extends Controller
{
     public function getVillage()
    {
        $VillageS = Village::all();
        $data = [
            'status' => 200,
            'arrondissement' => $VillageS
        ];
        if($VillageS->count()>0){
            return response()->json($data, 200);
        }else{
            return response()->json(['status' => 404, 'message' => 'pas village trouver'], 404);
        } 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getVillageByCodes($codes)
    {
        $vill = Village::where('code_vill', $codes)->first();
        if($vill){
            return response()->json([
                'status' => 200,
                'village' =>  $vill
            ], 200);            
        }else{
            return response()->json([
                'status' => 404,
                'message' => "aucune de arrondissement trouvée!"
            ], 404);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createVillage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:191',
            'code_vill' => 'required|string|max:4|unique:villages,code_vill',
            'commune_id' => 'required|integer|max:10',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);

        }else{
            $arro = Village::create([
                'nom' => $request->nom,
                'code_vill' =>strtoupper($request->code_vill),
                'commune_id' => $request->commune_id
            ]);

            if($arro){
                return response()->json([
                    'status' => 200,
                    'message' => "Village crée avec success!"
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
     * Show the form for editing the specified resource.
     */
  
    /**
     * Update the specified resource in storage.
     */
public function updateVillageByCodes(string $codes, Request $request)
{
    $codes = strtoupper($codes);
    $village = Village::where('code_vill', $codes)->first();
    

    if ($village) {
        // Effectuer les modifications sur le village en fonction des données reçues dans la requête
        $village->update([
            'name' => $request->input('name'), 
            'code_vill' => $request->input('code_vill'),
            // Ajoutez d'autres champs à mettre à jour ici...
        ]);
 
        return response()->json([
            'status' => 200,
            'message' => "Village modifié avec succès!",
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
            'message' => "Village non trouvé!"
        ], 404);
    }
}


     public function updateVillage(Request $request, string $code){
        $validator = Validator::make($request->all(), [
            'nom' => 'string|max:191',
            'code_vill' => 'string|max:4|unique:villages,code_vill',
            'commune_id' => 'integer|max:14',
            'superficie_km2' => 'numeric',
            'population_masculine' => 'integer',
            'population_feminine' => 'integer',
            'population' => 'integer',
            'densite' => 'numeric|max:191',
            'incidence_pauvrete' => 'numeric|max:191',
            'taux_scolarisation_globale' => 'numeric|max:191',
            'taux_alphabetisation_general' => 'numeric|max:191',
            'taux_enregistrement_etat_civil' => 'numeric|max:191',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);

        }else{
            $vill = Village::where('code_vill', $code)->first();
            if($vill){
                $vill->update([
                    'nom' => $request->nom,
                    'code_vill' => strtoupper($request->code_vill),
                    'commune_id' => $request->commune_id,
                    'superficie_km2' => $request->superficie_km2,
                    'population_masculine' => $request->population_masculine,
                    'population_feminine' => $request->population_feminine,
                    'population' => $request->population,
                    'incidence_pauvrete' => $request->incidence_pauvrete,
                    'taux_scolarisation_globale' => $request->taux_scolarisation_globale,
                    'taux_alphabetisation_general' => $request->taux_alphabetisation_general,
                    'taux_enregistrement_etat_civil' => $request->taux_enregistrement_etat_civil,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => "Village mis à jour avec success!"
                ], 200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "Pas de village trouvé!"
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyVillage(string $codes)
     {
        $villages = Village::where('code_vill', $codes)->first();

        if($villages){
            $villages->delete();
            return response()->json([
                'status' => 200,
                'message' => "Village  supprimée avec success!"
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Village non trouvé!"
            ], 404);
        }
    }
}
