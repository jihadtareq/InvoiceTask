<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'client_name'=>$this->client->full_name,
            'client_mobile'=>$this->client->mobile,
            'client_email'=>$this->client->email,
            'amount'=>$this->amount,
            'due_date'=>$this->due_date,
        ];
    }
}
