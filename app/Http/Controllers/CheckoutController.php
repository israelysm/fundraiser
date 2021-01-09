<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Campaign;
use DB;

class CheckoutController extends Controller
{
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
        $requestData = $request->all();
        $data['donor_name']=$requestData['name'];
        $data['email']=$requestData['email'];
        $data['mobile']=$requestData['mobile'];
        $data['amount']=$requestData['amount'];
        $data['campaign_id']=$requestData['campaignid'];
        $data['receipt_number']= rand();

        $res = Transaction::Create( $data);
        $this->addAmount($data['amount'],$data['campaign_id']);
        $data=['status'=>'success','receiptno'=>$data['receipt_number']];
        return response()->json($data);
    }

    public function addAmount($amount,$id)
    {
        $res = DB::table('campaigns')
        ->where('id', $id )
        ->increment('amount', $amount);
        //print_r($res);
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
