<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apiUrl = env('API_URL');
        $campaigns = Campaign::where('status',1)->get()->toArray();
        return view('campaign.campaign', ['campaignlist'=>$campaigns,'apiUrl'=>$apiUrl]);
    }

    public function getcampaign()
    {
        $campaigns = Campaign::where('status',1)->get()->toArray();
        return response($campaigns)->header('Content-Type', 'application/json');
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
            'title' => 'required',
            'slug' => 'required',
            'feature_image' => 'required',
            'target_amount' => 'required',
            'story' => 'required',
        ]);
        $requestData= $request->all();
        $requestData['status'] = 1;
        if($requestData['id']=='undefined'){
            $res = Campaign::Create($requestData);
        } else {
            $res =Campaign::where('id', $requestData['id'])->update($requestData);
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
        $res = Campaign::destroy($id);
        return redirect()->back();
    }
}
