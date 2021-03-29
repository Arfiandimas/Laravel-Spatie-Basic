<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class GivePermissionUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $response = User::with('permissions')->orderBy('id', 'desc')->get();
            return ngcApiReturn($response);
        } catch (\Exception $e) {
            return ngcApiCatch($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|array',
            'name.*' => 'exists:permissions,name'
        ]);

        try {
            $user = User::find($id);
            $permission = $request->name;
            $user->givePermissionTo($permission);
            $response = $user::with('permissions')->where('id', $id)->first();
            return ngcApiCreated($response);
        } catch (\Exception $e) {
            return ngcApiCatch($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
