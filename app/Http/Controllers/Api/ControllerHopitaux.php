<?php

namespace App\Http\Controllers\Api;

use App\Models\Hopital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ControllerHopitaux extends Controller
{
    public function getHopitaux()
    {
        $Hopital = Hopital::all();
        $data = [
            'status' => 200,
            'departement' => $Hopital,
        ];
        if($Hopital->count()>0){
            return response()->json($data, 200);
        }else{
            return response()->json(['status' => 404, 'message' => 'aucune Hopital  trouvee'], 404);
        } 
    }

//Recuperer un hopital grace a son id
    public function getHopitalById($id)
    {
        $Hopital = Hopital::find($id);
        $data = [
          'status' => 200,
            'Hopital' => $Hopital,
        ];
        if($Hopital){
            return response()->json($data, 200);
        }else{
            return response()->json(['status' => 404,'message' => 'aucune Hopital trouvee'], 404);
        } 
    }

    //Ajouter un hopital
    // public function getHopialById($id)
    // {
    //     $Hopital = Hopital::find($id);
    //     if($Hopital){
    //         return response()->json([
    //             'status' => 200,
    //             'arrondisement' => $Hopital,
    //             // 'departement' => $arrondissement->departement->region,
    //             // 'region' => $arrondissement->departement->region
    //         ], 200);
    //     }else{
    //         return response()->json([
    //             'status' => 404,
    //             'message' => "aucune Hopital trouvée!"
    //         ], 404);
    //     }
        
    // }
//creer un Hopital
public function createHopital(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nom' => 'required|string|max:191',
        'adresse' => 'required|string',
        'commune_id' => 'required|integer'
    ]);

    if($validator->fails()){
        return response()->json([
            'status' => 422,
            'message' => $validator->messages()
        ], 422);

    }else{
        $hopital = Hopital::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'commune_id' => $request->commune_id,
        ]);

        if($hopital){
            return response()->json([
                'status' => 200,
                'message' => "Hopital créee avec success!"
            ], 200);
        }else{
            return response()->json([
                'status' => 500,
                'message' => "Quelques chose s'est passé!"
            ], 500);
        }
    }
}

// editer un hopital
public function updateHopital(Request $request, $id){
    $hopital = Hopital::find($id);

    if(!$hopital){
        return response()->json([
         'status' => 404,
         'message' => "aucune Hopital trouvée!"
        ], 404);
    }

    
    $validator = Validator::make($request->all(), [
        'nom' =>'required|string|max:191',
        'adresse' =>'required|string',
        'commune_id' =>'required|integer'
    ]);
    if($validator->fails()){
        return response()->json([
          'status' => 422,
          'message' => $validator->messages()
        ], 422);
    }
    $hopital->update($request->all());
if ($hopital){
return response()->json([
    'status' => 200,
    'message' => "Hopital modifié avec succès!"
  ], 200);
}else{
    return response()->json([
      'status' => 500,
      'message' => "Quelques chose s'est passé!"
    ], 500); 
}
    
}

//supprimer un hopital


public function deleteHopital($id){
    $hopital = Hopital::find($id);
    if(!$hopital){
        return response()->json([
        'status' => 404,
        'message' => "aucune Hopital trouvée!"
        ], 404);
    }
    $hopital->delete();
    return response()->json([
      'status' => 200,
      'message' => "Hopital supprimé avec succès!"
      ], 200);
}



}
