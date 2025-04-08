<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnderecoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'end_id' => $this->end_id,
            'end_tipo_logradouro' => $this->end_tipo_logradouro,
            'end_logradouro' => $this->end_logradouro,
            'end_numero' => $this->end_numero,
            'end_bairro' => $this->end_bairro,
            'cidade' => new CidadeResource($this->cidade),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
