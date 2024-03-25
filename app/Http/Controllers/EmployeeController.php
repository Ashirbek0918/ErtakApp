<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddFeedbackRequest;
use App\Http\Requests\UserGetRequest;
use App\Http\Resources\UserGetResorce;
use App\Models\Employee;
use App\Models\Feedback;
use App\Models\User;
use Google\Rpc\Context\AttributeContext\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $feedback = Feedback::create([
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
