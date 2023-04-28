<?php

namespace App\Http\Controllers\Api\v1;

use App\DTO\ProductDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Http\Resources\ProductsCollection;
use App\Http\Resources\ProductsResource;
use App\Services\ProductService;

class ProductsController extends Controller
{

    public function __construct(private ProductService $productService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ProductsCollection($this->productService->findAllProducts());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsRequest $request)
    {
        return new ProductsResource($this->productService->createProduct(
            new ProductDto($request->nome, $request->preco, $request->descricao)
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ProductsResource($this->productService->findProduct($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductsRequest $request, string $id)
    {
        return new ProductsResource(
            $this->productService->updateProduct(
                $id,
                new ProductDto($request->nome, $request->preco, $request->descricao)
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(['message' => 'Produto Excluído!'], 202);
    }
}
