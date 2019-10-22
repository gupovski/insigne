<?php

namespace App\Http\Controllers\Api;

use App\ApiUserData;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = (new ApiUserData())->getAllUsers();

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = (new ApiUserData())->getUser($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'login'=>'string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'first_name'=>'required_with:last_name|required_with:middle_name',
            'last_name'=>'required_with:first_name|required_with:middle_name',
            'middle_name'=>'required_with:first_name|required_with:last_name',
            'email'=>'email',
            'subscribe_end'=>'date',
        ]);

        $user->login = $request->get('login');
        $user->first_name =  $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->middle_name = $request->get('middle_name');
        $user->email = $request->get('email');
        if (!$request->get('subscribe_end')) {
            $user->deleteSubscribeEnd($user->id);
        } else {
            $user->setSubscribeEnd($user->id, $request->get('subscribe_end'));
        }

        if ($request->get('password')) {
            $user->password = $request->get('password');
        }

        $user->save();
        Cache::forget('users');

        return response()->json('success', 201);
    }
}
