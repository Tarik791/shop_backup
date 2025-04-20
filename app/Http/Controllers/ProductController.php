<?php
namespace App\Http\Controllers;

use App\Services\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getPaginatedProducts();
    
        return view('welcome', [
            'products' => $products
        ]);
    }

    public function show($uuid)
    {
        $product = $this->productService->getProductByUuidWithVariants($uuid);
        return view('ProductDetails', [
            'product' => $product,
        ]);
    }

}

?>