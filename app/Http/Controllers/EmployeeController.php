<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voice;
use App\Models\Employee;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserGetRequest;
use App\Http\Resources\UserGetResorce;
use App\Http\Requests\AddFeedbackRequest;
use Google\Rpc\Context\AttributeContext\Response;

class EmployeeController extends Controller
{
    public function login(Request $request){
        $user = Employee::where('email', $request->email)->first();
        $password = $user->password;
        if(!$user or !Hash::check($request->password,$password)){
            return response()->json(['error' => 'Password or email is incorrect']);
        }
        $token = $user->createToken('employee')->plainTextToken;
        return response()->json([
            'token' => $token
        ]);
    }


    public function writefeedback(AddFeedbackRequest $request){
        $user = Voice::find($request->voice_id)->user;
        $feedback = Feedback::create([
            'user_id'=>$user->id,
            'voice_id' => $request->voice_id,
            'feedback' => $request->feedback,
            'rating' => $request->rating
        ]);
        if($feedback){
            return response()->json([
                'success' =>true,
            ]);
        }
    }

    public function getUsers(){
        $users = User::all();
        $collection = [
            'users' => [

            ]
        ];
        foreach($users as $user){
            $collection['users'][] = new UserGetResorce($user);
        }
        if(!empty($collection['users'])){
            return response()->json([
                'success' => true,
                'data' => $collection
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => "Users not found"
        ]);
    }
}
