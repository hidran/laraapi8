<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = [
            'data' =>[],
            'message' => ''
        ];
        try{
            $res['data'] = User::orderBy('id','DESC')->get();
        } catch (\Exception $e){
            $res['message'] = $e->getMessage();
        }
        return $res;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = [
            'data' => [],
            'message' => 'User Created',
            'success' => true
        ];
        try {
            $userData = $request->except('id');
            $userData['password'] =  $userData['password'] ?? 'dededede';
            $userData['password'] =\Hash::make($userData['password'] );
            $user = new User();
            /*  $user->name = $request->input('name');
              $user->phone = $request->input('phone');
            */
            $user->fill($userData);
            $user->save();
            $res['data'] = $user;


        } catch (\Exception $e ){
            $res = [
                'data' => [],
                'message' => $e->getMessage(),
                'success' => false
            ];
        }
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show( $user)
    {
        $res = [
            'data' =>[],
            'message' => ''
        ];
        try{
            $res['data'] = User::findOrFail($user);
        } catch (\Exception $e){
            $res['message'] = $e->getMessage();
        }
        return $res;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->except(['id']);
        $res = [
            'data' => null,
            'message' => '',
            'success' => true
        ];

        try {
            $data['password'] = 'dededede';
            $User = User::findOrFail($user);
            $data['password'] = \Hash::make($data['password']);
            $User->update($data);
            $res['data'] = $User;
            $res['message'] = 'User updated!';
        } catch (\Exception $e) {
            $res['success'] = false;
            $res['message'] = $e->getMessage();
        }
        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
