<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get paginated products.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedProducts(int $perPage = 20)
    {
        return $this->productRepository->getAllProductsWithRelations($perPage);
    }

    public function getProductByUuidWithVariants(string $uuid)
    {
    return $this->productRepository->getProductWithVariants($uuid);
    }
}
?>