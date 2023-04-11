<?php

namespace App\Services\Contracts;

use App\DTO\ProductDto;

interface IProductService
{
    public function findAllProducts();
    public function findProduct(int $id);
    public function createProduct(ProductDto $userDto);
    public function updateProduct(int $id, ProductDto $productDto);
    public function deleteProduct(int $id);
}
