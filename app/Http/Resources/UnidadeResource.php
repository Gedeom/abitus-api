<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnidadeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'unid_id' => $this->unid_id,
            'unid_nome' => $this->unid_nome,
            'unid_sigla' => $this->unid_sigla,
            'endereco' => new UnidadeEnderecoResource($this->endereco),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
