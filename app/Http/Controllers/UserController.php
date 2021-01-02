<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // Check the status superadmin is created or not
    public function checkAdminAccountStatus(){
        try{
            $hasExistsSuperAdmin = DB::table('users')->where('role', 'superadmin')->exists();
            if($hasExistsSuperAdmin){
                return true;
            }
        } catch(\Illuminate\Database\QueryException $ex){
            $errorMessage = $ex->getMessage(); 
            return false;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8'
        ]);

        $request['role'] = 'user';
        $request['status'] = 1; 

        $user = User::updateOrCreate($request);
    }

    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8'
        ]);

        $requestData= $request->all();

        $requestData['password'] = Hash::make( $requestData['password']);

        $requestData['role'] = 'superadmin';
        $requestData['status'] = 1; 

        $user = User::updateOrCreate($requestData);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
