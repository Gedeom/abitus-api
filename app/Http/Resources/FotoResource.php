<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'fp_id' => $this->fp_id,
            'fp_hash' => $this->fp_hash,
            'fp_bucket' => $this->fp_bucket,
            'fp_data' => $this->fp_data,
            'pessoa' => new PessoaResource($this->pessoa),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
