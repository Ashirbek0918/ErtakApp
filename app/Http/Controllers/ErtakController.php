<?php

namespace App\Http\Controllers;

use App\Http\Requests\ErtakAddRequest;
use App\Http\Resources\ErtaksResource;
use App\Models\Ertak;
use Illuminate\Http\Request;

class ErtakController extends Controller
{
    public function create(ErtakAddRequest $request){
        Ertak::create([
            'name' => $request->name
        ]);
        return response()->json([
            'success' => true,
            'message' =>'Ertak added successfully'
        ]);
    }


    public function all(){
        $ertaks = ErtaksResource::collection(Ertak::all('id','name'));
        return response()->json([
            'data' => $ertaks
        ]);
    }
}
