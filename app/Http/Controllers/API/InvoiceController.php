<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Invoice;
use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\InvoiceResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmailJob;

class InvoiceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::paginate(30);

        return $this->sendResponse(InvoiceResource::collection($invoices),'Retrieve all invoices successfully',200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        $invoice = ' ';
        $clientArr['full_name']=$request->full_name;
        $clientArr['email']=$request->email;
        $clientArr['mobile']=$request->mobile;
        $clientArr['created_by']= Auth::user()->id;

        $invoiceArr['amount'] = $request->amount;
        $invoiceArr['due_date'] = $request->due_date;
        $invoiceArr['created_by']= Auth::user()->id;

        DB::transaction(function() use ($invoiceArr, $clientArr ,&$invoice)
        {
            $client = Client::where('email',$clientArr['email'])->first();

            if(!$client){
               $client = Client::create($clientArr);
            }

            $invoiceArr['client_id']=$client->id;

            $invoice = Invoice::create($invoiceArr);

            $details = array_merge($clientArr,$invoiceArr);

            SendEmailJob::dispatch($details);

        });

        return $this->sendResponse(new InvoiceResource($invoice),"Invoice is created successfully",201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return $this->sendResponse(new InvoiceResource($invoice)," ",200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {

        
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
