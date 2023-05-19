<?php

namespace App\Services;

use App\DTO\ProductDto;
use App\Repositories\Contracts\IProductRepository;
use App\Services\Contracts\IProductService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductService implements IProductService
{
    public function __construct(private IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function findAllProducts()
    {
        return $this->productRepository->findAll();
    }

    public function findProduct(int $id)
    {
        return $this->productRepository->findById($id);
    }

    public function createProduct(ProductDto $productDto)
    {
        DB::transaction(function () use ($productDto) {
            return $this->productRepository->create([
                'nome' => $productDto->nome,
                'preco' => $productDto->preco,
                'descricao' => $productDto->descricao,
                'slug' => Str::slug($productDto->nome, language: 'pt')
            ]);
        });
    }

    public function updateProduct(int $id, ProductDto $productDto)
    {
        DB::transaction(function () use ($productDto, $id) {
            return $this->productRepository->update(
                [
                    'nome' => $productDto->nome,
                    'preco' => $productDto->preco,
                    'descricao' => $productDto->descricao,
                    'slug' => Str::slug($productDto->nome, language: 'pt')
                ],
                $id
            );
        });
    }

    public function deleteProduct(int $id)
    {
        DB::transaction(function () use ($id) {
            return $this->productRepository->delete($id);
        });
    }
}
