<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;
use App\Models\Arrondissement;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ArrondissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getArrondissement()
    {
        $ArrondissM = Arrondissement::all();
        $data = [
            'status' => 200,
            'departement' => $ArrondissM,
        ];
        if($ArrondissM->count()>0){
            return response()->json($data, 200);
        }else{
            return response()->json(['status' => 404, 'message' => 'pas arrondissement trouver'], 404);
        } 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getArrondissementByCode($code_arr)
    {
        $arrondissement = Arrondissement::with('departement.region')->where('code_arr', $code_arr)->first();
        if($arrondissement){
            return response()->json([
                'status' => 200,
                'arrondisement' => $arrondissement,
                // 'departement' => $arrondissement->departement->region,
                // 'region' => $arrondissement->departement->region
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "aucune arrondissement trouvée!"
            ], 404);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createArrondissement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:191',
            'code_arr' => 'required|string|max:4|unique:arrondissements,code_arr',
            'code_dept' => [
                'string',
                'max:4',
                Rule::exists('departements', 'code_dept'),
            ],
            'departement_id' => 'required|integer|max:10',
            'superficie_km2' => 'numeric',
            'population_masculine' => 'integer',
            'population_feminine' => 'integer',
            'population' => 'integer',
            'taux_scolarisation_globale' => 'numeric|between:0,100',
            'incidence_pauvrete' => 'numeric|between:0,100',
            'taux_alphabetisation_general' => 'numeric|between:0,100',
            'taux_enregistrement_etat_civil' => 'numeric|between:0,100',

        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);

        }else{
            $depart = Arrondissement::create([
                'nom' => $request->nom,
                'code_arr' => strtoupper($request->code_arr),
                'code_dept' => strtoupper($request->code_dept),
                'departement_id' => $request->departement_id,
                'superficie_km2' => $request->superficie_km2,
                'population_masculine'=>$request->population_masculine,
                'population_feminine'=>$request->population_feminine,
                'population'=>$request->population,
                'taux_scolarisation_globale'=>$request->taux_scolarisation_globale,
                'incidence_pauvrete'=>$request->incidence_pauvrete,
                'taux_alphabetisation_general'=>$request->taux_alphabetisation_general,
                'taux_enregistrement_etat_civil'=>$request->taux_enregistrement_etat_civil,
            ]);

            if($depart){
                return response()->json([
                    'status' => 200,
                    'message' => "Arrondissement crée avec success!"
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
    public function getAllArrondondissementCommunes($id){
        $commune = Commune::where('arrondissement_id', $id)->get();

        if($commune->isNotEmpty()){
            return response()->json([
                'status'=> 200,
                'communes'=> $commune 
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Aucune(s) commune(s) trouvée(s)' 
            ]);
        }
    }
 

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function editArrondissement(Request $request, $code_arr)
    {
        $arrondissement = Arrondissement::where('code_arr', $code_arr)->first();
        if (!$arrondissement) {
            return response()->json([
                'status' => 404,
                'message' => "Arrondissement non trouvé."
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:191',
            'code_arr' => [
                'required',
                'string',
                'max:4',
                Rule::unique('arrondissements')->ignore($arrondissement->id),
            ],
            'code_dept' => [
                'string',
                'max:4',
                Rule::exists('departements', 'code_dept'),
            ],
            'departement_id' => 'required|integer|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'messages' => $validator->messages()
            ], 422);
        }

        $arrondissement->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => "Arrondissement modifié avec succès!"
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroyArrondissement(string $code_arr)
    {
        $arrondissement = Arrondissement::where('code_arr', $code_arr)->first();

        if ($arrondissement) {
            $arrondissement->delete();
    
            return response()->json([
                'status' => 200,
                'message' => 'Arrondissement supprimé avec succès.',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Arrondissement non trouvé avec l\'ID spécifié.',
            ], 404);
        }
    

    }
}
