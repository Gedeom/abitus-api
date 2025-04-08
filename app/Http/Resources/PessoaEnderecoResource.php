<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PessoaEnderecoResource extends JsonResource
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
            'pessoa' => new PessoaResource($this->pessoa),
            'endereco' => new EnderecoResource($this->endereco),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
