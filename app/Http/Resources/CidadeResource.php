<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CidadeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cid_id' => $this->cid_id,
            'cid_nome' => $this->cid_nome,
            'cid_uf' => $this->cid_uf,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
