<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Arrondissement;
use App\Models\Commune;
use App\Models\Lycee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommuneController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function createCommune(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:191',
            'code_com' => 'required|string|max:4|unique:communes,code_com',
            'code_arr' => 'string|max:4',
            'type' => 'enum',
            'arrondissement_id' => 'required|integer|max:14',
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
            $commune = Commune::create([
                'nom' => $request->nom,
                'code_com' => strtoupper($request->code_com),
                'arrondissement_id' => $request->arrondissement_id,
            ]);

            if($commune){
                return response()->json([
                    'status' => 200,
                    'message' => "Commune créée avec success!"
                ], 200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "Quelques s'est passé!"
                ], 500);
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function getCommune(){
        $commune = Commune::all();
        $data = [
            'status' => 200,
            'communes' => $commune
        ];
        if($commune->count()>0){
            return response()->json($data, 200);
        }else{
            return response()->json(['status' => 404, 'message' => "Pas d'enrégistrement(s) trouvé(s)!"], 404);
        } 
    }

    /**
     * Display the specified resource.
     */
    public function getCommuneByCode(string $code)
    {
        $commune = Commune::where("code_com", $code)->first();
        if($commune){
            // if($commune->region->id){
                return response()->json([
                        'status' => 200,
                        'region' => $commune
                    ], 200);
            // }else{
            //     return response()->json([
            //         'status' => 404,
            //         'message' => "Cette identifiant n'existe pas dans la table region!"
            //     ], 404);
            // }
            
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Pas de commune avec ce code trouvé!"
            ], 404);
        }
    }

    public function getAllCommuneVillages($id){
        $vill = Village::where('commune_id', $id)->get();

        if($vill->isNotEmpty()){
            return response()->json([
                'status'=> 200,
                'villages'=> $vill 
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Aucun(s) village(s) trouvé(s)' 
            ]);
        }
    }

    public function getAllCommuneEcoles($id){
        $ecol = Ecole::where('commune_id', $id)->get();

        if($ecol->isNotEmpty()){
            return response()->json([
                'status'=> 200,
                'ecoles'=> $ecol 
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Aucune(s) école(s) trouvée(s)' 
            ]);
        }
    }

    public function getAllCommuneLycees($id){
        $lyc = Lycee::where('commune_id', $id)->get();

        if($lyc->isNotEmpty()){
            return response()->json([
                'status'=> 200,
                'lycees'=> $lyc 
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Aucun(s) lycee(s) trouvé(s)' 
            ]);
        }
    }

    public function getAllCommuneHopitaux($id){
        $hop = Hopital::where('commune_id', $id)->get();

        if($hop->isNotEmpty()){
            return response()->json([
                'status'=> 200,
                'hopitaux'=> $hop 
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Aucun(s) hopital(s) trouvé(s)' 
            ]);
        }
    }

    public function updateCommune(Request $request, string $code){
        $validator = Validator::make($request->all(), [
            'nom' => 'string|max:191',
            'code_com' => 'string|max:4|unique:communes,code_com',
            'code_arr' => 'string|max:4',
            'type' => 'enum',
            'arrondissement_id' => 'integer|max:14',
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
            $commune = Commune::where('code_com', $code)->first();
            if($commune){
                $commune->update([
                    'nom' => $request->nom,
                    'code_com' => strtoupper($request->code_com),
                    'arrondissement_id' => $request->arrondissement_id,
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
                    'message' => "Commune mis à jour avec success!"
                ], 200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "Pas de Commune trouvée!"
                ], 404);
            }
        }
    }

    public function deleteCommune(string $code)
    {
        $commune = Commune::where('code_com', $code)->first();

        if($commune){
            $commune->delete();
            return response()->json([
                'status' => 200,
                'message' => "Commune supprimée avec success!"
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Commune non trouvée!"
            ], 404);
        }
    }

}
