<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    public function showUser($id=null){
      if($id==''){
          $users=User::get();
          return response()->json(['users'=>$users], 200);
      }else{
        $user=User::find($id);
        return response()->json(['user'=>$user], 200);
      }
    }

    public function addUser(Request $request){
    $rulls=[
        'name'=>'required',
        'email'=>'required|email|unique:users',
        'password'=>'required',
    ];
    $customMessage=[
        'name.required'=>'Name field is requird',
        'email.required'=>'Email field is requird',
        'email.unique'=>'Email field is unique',
        'password.required'=>'Password field is requird',
    ];
    $validator=Validator::make($request->all(), $rulls, $customMessage);
    if($validator->fails()){
        return response()->json($validator->errors(), 422);
    }
    $user=new User();
    $user->name=$request->name;
    $user->email=$request->email;
    $user->password=bcrypt($request->password);
    $user->save();
    $message="User add successfully";
    return response()->json(['message'=>$message], 201);
    }
    public function addMultiUser(Request $request){
       $data = $request->all();
        $rulls=[
            'users.*.name'=>'required',
            'users.*.email'=>'required|email|unique:users',
            'users.*.password'=>'required',
        ];
        $customMessage=[
            'users.*.name.required'=>'Name field is requird',
            'users.*.email.required'=>'Email field is requird',
            'users.*.email.unique'=>'Email field is unique',
            'users.*.password.required'=>'Password field is requird',
        ];
        $validator=Validator::make($data, $rulls, $customMessage);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        foreach($data['users'] as $addUser){
        $user=new User();
        $user->name=$addUser['name'];
        $user->email=$addUser['email'];
        $user->password=bcrypt($addUser['password']);
        $user->save();
        $message="User add successfully";
        }
        return response()->json(['message'=>$message], 201);
    }
    
    
        public function updateUser(Request $request, $id){
    $rulls=[
        'name'=>'required',
        'password'=>'required',
    ];
    $customMessage=[
        'name.required'=>'Name field is requird',
        'password.required'=>'Password field is requird',
    ];
    $validator=Validator::make($request->all(), $rulls, $customMessage);
    if($validator->fails()){
        return response()->json($validator->errors(), 422);
    }
    $user= User::findOrFail($id);
    $user->name=$request->name;
    $user->password=bcrypt($request->password);
    $user->save();
    $message="User update successfully";
    return response()->json(['message'=>$message], 201);
    }
}
