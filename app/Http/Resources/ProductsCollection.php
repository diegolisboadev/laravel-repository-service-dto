<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
        ];
    }

    public function with(Request $request): array
    {
        return [
            'status' => 'Sucesso',
            'message' => 'Lista de Produtos recuperada com sucesso!',
        ];
    }
}
