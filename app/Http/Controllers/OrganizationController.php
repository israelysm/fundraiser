<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Common;
use DB;

class OrganizationController extends Controller
{
    // Check the status whether organization is created or not
    public function checkOrganizationStatus(){
        try{
            $hasExistsOrganization = DB::table('common')->where('name', 'organization_name')->exists();
            if($hasExistsOrganization){
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
            'name' => 'required',
            'email' => 'required|email',
            'phonenumber' => 'required',
            'logo' => 'required',
            'address' => 'required',
        ]);
        $common = new Common;
        $common->name = 'organization_name';
        $common->value = $request->input('name');
        $common->save();
        $common1 = new Common;
        $common1->name = 'email';
        $common1->value = $request->input('email');
        $common1->save();
        $common2 = new Common;
        $common2->name = 'phonenumber';
        $common2->value = $request->input('phonenumber');
        $common2->save();
        $common3 = new Common;
        $common3->name = 'logo';
        $common3->value = $request->input('logo');
        $common3->save();
        $common4 = new Common;
        $common4->name = 'address';
        $common4->value = $request->input('address');
        $common4->save();

        return true;

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
