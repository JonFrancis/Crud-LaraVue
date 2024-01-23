<?php

namespace App\Http\Controllers\Api;

use App\Models\AllUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AllUsersController extends Controller
{
  //Index page or Home page
  //If the database don't have users(when the count function = 0), it will print 'No user found in database'
  //If database have 1 or more users it will print all of them
    public function index()
    {
        $allusers = AllUsers::all();
        if($allusers->count() > 0){
            $data = [
                'status' => 200,
                'allusers' => $allusers,
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                'status' => 404,
                'message' => 'No user found in database',
            ];
            return response()->json($data, 404);
        }
    }

    //When add an user validator will check, First Name, Last name and Cellphone
    //If it fails the validator message is send to front
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Username' => 'required|string',
            'Password' => 'required|string',
            'First_Name' => 'required|alpha',
            'Last_Name' => 'required|alpha',
            'Age' => 'nullable|integer',
            'Cellphone' => 'required|numeric|digits:11',
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{
            
            $allusers = AllUsers::create([
                'Username' => $request->Username,
                'Password' => $request->Password,
                'First_Name' => $request->First_Name,
                'Last_Name' => $request->Last_Name,
                'Age' => $request->Age,
                'Cellphone' => $request->Cellphone,
            ]);

            if($allusers){

                return response()->json([
                    'status' => 200,
                    'userId' => $allusers->id,
                    'message' => "User created successfully"
                ], 200);
            }else{

                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong while creating user"
                ], 500);
            }
        }
    }

    //Show function is not used by the routes
    //But it allows the access of 1 specific users instead of showing all of them
    public function show($id)
    {
        $allusers = AllUsers::find($id);
        if($allusers){
            return response()->json([
                'status' => 200,
                'user' => $allusers
            ], 200);
        }else{

            return response()->json([
                'status' => 404,
                'message' => "User not found"
            ],404);
        }
    }

    //Edit function return the user to complete the gaps in front end
    public function edit($id)
    {
        $allusers = AllUsers::find($id);
        if($allusers){
            return response()->json([
                'status' => 200,
                'message' => $allusers
            ], 200);
        }else{

            return response()->json([
                'status' => 404,
                'message' => "User not found"
            ],404);
        }
    }

    //Update function replace the data updated in database
    //Also have a validator
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'Username' => 'required|string',
            'Password' => 'required|string',
            'First_Name' => 'required|alpha',
            'Last_Name' => 'required|alpha',
            'Age' => 'nullable|integer',
            'Cellphone' => 'required|numeric|digits:11',
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{
            $allusers = AllUsers::find($id);

            if($allusers){

                $allusers->update([
                    'Username' => $request->Username,
                    'Password' => $request->Password,
                    'First_Name' => $request->First_Name,
                    'Last_Name' => $request->Last_Name,
                    'Age' => $request->Age,
                    'Cellphone' => $request->Cellphone,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "User updated successfully"
                ], 200);
            }else{

                return response()->json([
                    'status' => 400,
                    'message' => "User not found"
                ], 400);
            }
        }
    }

    //Destroy just delete the user chosen
    public function destroy($id)
    {
        $allusers = AllUsers::find($id);
        if($allusers){
            $allusers->delete();

            return response()->json([
                'status' => 200,
                'message' => 'User deleted from database successfully'
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'This user can\'t be deleted because it doesn\'t exist'
            ],404);
        }
    }
}
