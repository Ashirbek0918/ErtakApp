<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserGetRequest;
use App\Http\Requests\VoiceAddRequest;
use App\Http\Resources\UserVoice;
use App\Models\User;
use App\Models\Voice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addvoice(VoiceAddRequest $request){
        $user = User::where('device_key', $request->device_key)->first();
        $apk = $request->device_key;
        if(!$user){
            $user = User::create([
                'name' => $request->name,
                'device_key' => $apk
            ]);
        }
        if($request->hasFile('voice')){
            $file = $request->file('voice');
            $file_name = time()."_".Str::random(10).".".$file->getClientOriginalExtension();
            $file->move(public_path('voices'), $file_name);
            $file_url = env('APP_URL').'/public/voices/'.$file_name;
            Voice::create([
                'user_id' =>$user->id,
                'test_id' =>$request->test_id,
                'voice_name' =>$file_name,
                'voice'=>$file_url
            ]);
            return response()->json([
                'success' => true,
            ]);
        }
        return response()->json(['error' =>"Something went wrong"]);   
    }
        
    public function getVoice(UserGetRequest $request){
        $user = User::where('device_key',$request->device_key)->first();
        if($user){
            $voices = $user->voices()->orderBy('created_at', 'desc')->get();
            $collection = [
                'device_key' => $request->device_key,
                'voices' => []
            ];
            foreach($voices as $voice){
                $voice->update([
                    'status' =>"checked",
                ]);
                $collection['voices'][] = new UserVoice($voice);
            }
            return response()->json([
                'success' => true,
                'data' => $collection]);
        }
        return response()->json(['error' => "Invalid device key"]);
    }
    
}
