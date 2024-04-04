<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionAddRequest;
use App\Http\Resources\AllQuestionsResource;
use App\Models\Ertak;
use App\Models\Question;

class QuestionController extends Controller
{
    public function add (QuestionAddRequest $request){
        if($request->hasFile('audio')){
            $file = $request->file('audio');
            $file_name = time()."_".Str::random(10).".".$file->getClientOriginalExtension();
            $file->move(public_path('test/audios'), $file_name);
            $file_url = env('APP_URL').'/test/audios'.$file_name;
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = time()."_".Str::random(10).".".$image->getClientOriginalExtension();
                $image->move(public_path('test/images'), $image_name);
                $image_url = env('APP_URL').'/test/images/'.$image_name;
            }
            Question::create([
                'ertak_id' => $request->ertak_id,
                'audio_url' => $file_url,
                'image_url' => $image_url?? null
            ]);
            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function alltests(Ertak $ertak) {
        $tests = $ertak->questions;
        if(count($tests) != 0){
            $tests = AllQuestionsResource::collection($tests);
            return response()->json([
                'data' => $tests
            ]);
        }
        return response()->json([
            'message' => 'Tests not found'
        ],404);
        
    }
}
