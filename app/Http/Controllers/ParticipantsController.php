<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

use function Pest\Laravel\get;
use function Pest\Laravel\json;

class ParticipantsController extends Controller
{
    public function addParticipants(Request $request){
        $validator = Validator::make($request->all(),[
            'fullname' => 'required|string|min:10|max:100',
            'email' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 422);
        }

        Participant::create([
            'fullname' =>$request->get('fullname'),
            'email'=>$request->get('email'),
        ]);
        return response()->json(['message'=> 'Participant Added  successfuly'], 201);
    }

    public function getParticipants(){
        $parcipants = Participant::all();

        if($parcipants->isEmpty()){
            return response()->json(['error' => 'No Participant Found'], 404);
        }

        return response()->json($parcipants, 200);
    }

    public function getParticipantsById($id){
        $Participant = Participant::find($id);

        if(!$Participant){
            return response()->json(['error' => 'No participant Found'], 404);
        }
    }

    public function updateParticipantById(Request $request ,$id){
        $Participant = Participant::find($id);

        if(!$Participant){
            return response()->json(['error' => 'No participant Found'], 404);
        }

        $validator = Validator::make($request->all(),[
            'fullname' => 'sometimes|string|min:10|max:100',
            'email' => 'sometimes|string',
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 422);
        }
        if($request->has('fullname')){
            $Participant->fullname = $request->fullname;
        }
        if($request->has('email')){
            $Participant->email = $request->email;
        }
        $Participant->update();
        return response()->json(['message' => 'Participant update successfuly'], 200);
        
    }

    public function deleteParticipantById($id){
        $participant = Participant::find($id);

        if(!$participant){
            return response()->json(['error' => 'No participant Found'], 404);
        }

        $participant->delete();

        return response()->json(['message' => 'Participant Delete successfuly'], 200);
    }
}
