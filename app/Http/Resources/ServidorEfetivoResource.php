<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServidorEfetivoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'se_matricula' => $this->se_matricula,
            'lotacao' => new LotacaoResource($this->lotacaoAtiva),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function additionalData(array $data) {}
}
