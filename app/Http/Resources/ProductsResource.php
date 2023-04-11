<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nome' => $this->nome,
            'preco' => $this->preco,
            'descricao' => $this->descricao,
            'slug' => $this->slug,
            'data_criacao' => $this->created_at->format('Y-m-d h:i:s'),
            'data_atualizacao' => $this->updated_at->format('Y-m-d h:i:s')
        ];
    }
}
