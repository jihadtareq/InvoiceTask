<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Support\Facades\Auth;

class ClientController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('invoices')->paginate(30);

        return $this->sendResponse(ClientResource::collection($clients),'Retrieve all clients successfully',200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $data['full_name']= $request->full_name;
        $data['mobile']= $request->mobile;
        $data['email']= $request->email;
        $data['created_by']= Auth::user()->id;

        $client = Client::create($data);

        return $this->sendResponse(new ClientResource($client),"Client is created successfully",201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);

        return $this->sendResponse(new ClientResource($client),' ',200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request,Client $client)
    {

        $data['full_name']= $request->full_name;
        $data['mobile']= $request->mobile;
        $data['email']= $request->email;

        $client->update($data);
        return $this->sendResponse(new ClientResource($client) ,"Client is updated successfully",201);
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
