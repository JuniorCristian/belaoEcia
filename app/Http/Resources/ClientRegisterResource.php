<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientRegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status' => 201,
            'data' => [
                'nome' => $this->nome,
                'email' => $this->email,
                'doc_identificacao' => $this->doc_identificacao

            ]
        ];
    }
}
