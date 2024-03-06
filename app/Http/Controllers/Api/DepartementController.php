<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use App\Models\Departement;
use App\Models\Arrondissement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getDepartement(){
        $depart = Departement::all();
        $data = [
            'status' => 200,
            'departement' => $depart
        ];
        if($depart->count()>0){
            return response()->json($data, 200);
        }else{
            return response()->json(['status' => 404, 'message' => 'No records depart found'], 404);
        } 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createDepartement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:191',
            'code_dept' => 'required|string|max:4|unique:departements,code_dept',
            'region_id' => 'required|integer|max:14',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);

        }else{
            $region = Region::where('id', $request->region_id)->first();
            $depart = Departement::create([
                'nom' => $request->nom,
                'code_dept' => strtoupper($request->code_dept),
                'code_reg' => $region->code_reg,
                'region_id' => $request->region_id,
            ]);

            if($depart){
                return response()->json([
                    'status' => 200,
                    'message' => "Departement crée avec success!"
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
     * Display the specified resource.
     */
    public function getDepartementByCode(string $code)
    {
        $dept = Departement::where("code_dept", $code)->first();
        if($dept){
            if($dept->region->id){
                return response()->json([
                        'status' => 200,
                        'departement' => $dept
                    ], 200);
                // $dept->region->nom;
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "Cette identifiant n'existe pas dans la table region!"
                ], 404);
            }
            
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Pas de département avec ce code trouvé!"
            ], 404);
        }
    }

    public function getAllDepartementArrondissements(int $id){
        $arr = Arrondissement::where('departement_id', $id)->get();

        if($arr->isNotEmppty()){
            return response()->json([
                "status" => 200,
                "arrondissements" => $arr
            ], 200);
        }else{
            return response()->json([
                'status' => 500,
                'message' => "Aucun(s) arrondissement(s) trouvé(s) pour ce département!"
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
   public function updateDepartementByCode(Request $request, string $code){
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:191',
            'code_dept' => 'required|string|max:4',
            'region_id' => 'required|integer|max:10',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);

        }else{
            $dept = Departement::where("code_dept", $code)->first();
            if($dept){
                $region = Region::where('id', $request->region_id)->first();
                $dept->update([
                    'nom' => $request->nom,
                    'code_dept' => strtoupper($request->code_dept),
                    'code_reg' => $region->code_reg,
                    'region_id' => $request->region_id,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => "Département mis à jour avec success!"
                ], 200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "Pas de département trouvé!"
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteDepartement(string $code)
    {
        $dept = Departement::find('code_dept', $code)->first();

        if($dept){
            $dept->delete();
            return response()->json([
                'status' => 200,
                'message' => "Departement supprimé avec success!"
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Departement non trouvé!"
            ], 404);
        }
    }
}
