<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LotacaoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'lot_id' => $this->lot_id,
            'pessoa' => new PessoaResource($this->pessoa),
            'unidade' => new UnidadeResource($this->unidade),
            'lot_data_lotacao' => $this->lot_data_lotacao,
            'lot_data_remocao' => $this->lot_data_remocao,
            'lot_portaria' => $this->lot_portaria,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
