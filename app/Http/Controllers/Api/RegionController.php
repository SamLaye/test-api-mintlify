<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use App\Models\Departement;
use App\Models\Arrondissement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function getRegion(){
        $regions = Region::all();
        $data = [
            'status' => 200,
            'regions' => $regions
        ];
        if($regions->count()>0){
            return response()->json($data, 200);
        }else{
            return response()->json(['status' => 404, 'message' => 'No records found'], 404);
        } 
    }

    public function createRegion(Request $request) {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:191',
            'code_reg' => 'required|string|max:4|unique:regions,code_reg',
            'superficie_km2' => 'numeric',
            'population_masculine' => 'integer',
            'population_feminine' => 'integer',
            'population' => 'integer',
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
            $region = Region::create([
                'nom' => $request->nom,
                'code_reg' => strtoupper($request->code_reg),
                'superficie_km2' => $request->superficie_km2,
                'population_masculine' => $request->population_masculine,
                'population_feminine' => $request->population_feminine,
                'population' => $request->population,
                'incidence_pauvrete' => $request->incidence_pauvrete,
                'taux_scolarisation_globale' => $request->taux_scolarisation_globale,
                'taux_alphabetisation_general' => $request->taux_alphabetisation_general,
                'taux_enregistrement_etat_civil' => $request->taux_enregistrement_etat_civil,
            ]);

            if($region){
                return response()->json([
                    'status' => 200,
                    'message' => "Region créée avec success!"
                ], 200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "Quelque chose s'est passé!"
                ], 500);
            }
        }
    }

    public function getRegionByCode(string $code) {
        $region = Region::where('code_reg', $code)->first();
        if($region){
            return response()->json([
                'status' => 200,
                'region' => $region
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Pas de région trouvée!"
            ], 404);
        }
    }


    public function editRegionById($id) {
        $region = Region::find($id);
        if($region){
            return response()->json([
                'status' => 200,
                'region' => $region
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Pas de région trouvée!"
            ], 404);
        }
    }

    public function updateRegionByCode(Request $request, string $code){
        $validator = Validator::make($request->all(), [
            'nom' => 'string|max:191',
            'code_reg' => 'string|max:4|unique:regions,code_reg',
            'superficie_km2' => 'numeric',
            'population_masculine' => 'integer',
            'population_feminine' => 'integer',
            'population' => 'integer',
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
            $region = Region::where('code_reg', $code)->first();
            if($region){
                $region->update([
                    'nom' => $request->nom,
                    'code_reg' => strtoupper($request->code_reg),
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
                    'message' => "Region mis à jour avec success!"
                ], 200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "Pas de région trouvée!"
                ], 404);
            }
        }
    }

    public function deleteRegion(string $code)
    {
        $reg = Region::where('code_reg', $code)->first();

        if($reg){
            $reg->delete();
            return response()->json([
                'status' => 200,
                'message' => "Région supprimée avec success!"
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Région non trouvé!"
            ], 404);
        }
    }

    public function getLocationByCode(string $code){
        $loc = Region::where('code_reg', $code)->first() 
                ??
                Departement::where('code_dept', $code)->first()
                ??
                Arrondissement::where('code_arr', $code)->first()
                ??
                Village::where('code_vill', $code)->first();

        if($loc){
            return response()->json([
                'status' => 200,
                'region' => $loc
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Ce code n'existe pas"
            ], 404);
        }
    }

    public function getAllRegionDepartements($id){
        $departs = Departement::where('region_id', $id)->get();

        if($departs->isNotEmpty()){
            return response()->json([
                'status'=> 200,
                'departements'=> $departs 
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Aucun(s) département(s) trouvé(s)' 
            ]);
        }
    }
}
