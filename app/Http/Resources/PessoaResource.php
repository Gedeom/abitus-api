<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PessoaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'pes_id' => $this->pes_id,
            'pes_nome' => $this->pes_nome,
            'pes_data_nascimento' => $this->pes_data_nascimento,
            'idade' => $this->idade(),
            'pes_sexo' => $this->pes_sexo,
            'pes_mae' => $this->pes_mae,
            'pes_pai' => $this->pes_pai,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
