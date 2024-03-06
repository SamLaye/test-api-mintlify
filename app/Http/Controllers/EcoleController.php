<?php

namespace App\Http\Controllers;

use App\Models\Ecole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EcoleController extends Controller
{
    public function getEcole()
    {
        // Logique pour afficher la liste des écoles
        $ecoles = Ecole::all();
        $data = [
            'status' => 200,
            'ecoles' => $ecoles
        ];
        if($ecoles->count()>0){
            return response()->json($data, 200);
        }else{
            return response()->json([
                'status' => 404, 
                'message' => 'No records found'
            ], 404);
        } 
    
    }

    public function createEcole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:191',
            'adresse' => 'required|string|max:191',
            'commune_id' => 'required|integer|max:25',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);

        }else{
            $com = Ecole::create([
                'nom' => $request->nom,
                'adresse' =>strtoupper($request->adresse),
                'commune_id' => $request->commune_id
            ]);

            if($com){
                return response()->json([
                    'status' => 200,
                    'message' => "Ecole crée avec success!"
                ], 200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "Désolé, une erreur s'est produite pendant le traitement de votre demande !"
                ], 500);
            }
        }
    }

    // public function create()
    // {
    //     // Logique pour afficher le formulaire de création d'une nouvelle école
        
    // }

    public function store(Request $request)
    {
        // Logique pour enregistrer une nouvelle école dans la base de données
    }

    public function show($id)
    {
        // Logique pour afficher les détails d'une école spécifique
    }

    public function edit($id)
    {
        // Logique pour afficher le formulaire d'édition d'une école
    }

    public function update(Request $request, $id)
    {
        // Logique pour mettre à jour les informations d'une école dans la base de données
    }

    public function destroy($id)
    {
        // Logique pour supprimer une école de la base de données
    }
}
