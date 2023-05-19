<?php

namespace App\DTO;

class ProductDto
{
    public function __construct(
        public readonly string $nome,
        public readonly float $preco,
        public readonly string $descricao,
        public readonly ?string $slug = null
    ) {
    }
}
