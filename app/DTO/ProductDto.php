<?php

namespace App\DTO;

class ProductDto
{
    public function __construct(
        public string $nome,
        public float $preco,
        public string $descricao,
        public ?string $slug = null
    ) {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->descricao = $descricao;
        $this->slug = $slug;
    }
}
