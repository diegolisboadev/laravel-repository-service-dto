<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\IProductRepository;

class ProductRepository extends AbstractRepository implements IProductRepository
{
    protected $model = Product::class;
}
