<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserActionController extends Controller
{
    public function updateUser(Request $request)
    {
        $user = auth("api")->user();

        if (empty($user)) {
            return $this->sendResponse($user, 'User must be connected');
        }

        $user->phone_number = $request->email == "" ? $user->email : $request->email;
        // $user->phone_number = $request->password == "" ? $user->password : $request->password;
        $user->phone_number = $request->firstname == "" ? $user->firstname : $request->firstname;
        $user->phone_number = $request->lastname == "" ? $user->lastname : $request->lastname;
        // $user->phone_number = $request->name == "" ? $user->name : $request->name;
        $user->phone_number = $request->dial_code == "" ? $user->dial_code : $request->dial_code;
        $user->phone_number = $request->phone_number == "" ? $user->phone_number : $request->phone_number;
        $user->phone_number = $request->profession == "" ? $user->profession : $request->profession;
        $user->phone_number = $request->photo_url == "" ? $user->photo_url : $request->photo_url;
        $user->phone_number = $request->is_active == "" ? $user->is_active : $request->is_active;
        $user->phone_number = $request->is_professional == "" ? $user->is_professional : $request->is_professional;
        $user->phone_number = $request->email == "" ? $user->email : $request->email;

        dd($user);
        // $user->phone_number = $request->email_verified_at == "" ? $user->email_verified_at : $request->email_verified_at;
        // $user->phone_number = $request->password == "" ? $user->password : $request->password;
        // $user->phone_number = $request->user_types_id == "" ? $user->user_types_id : $request->user_types_id;

        // $user->save();
    }
}
