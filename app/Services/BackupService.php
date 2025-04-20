<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Variant;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Log;
use Exception;

class BackupService
{
    /**
     * Run the backup process.
     *
     * @return bool
     */
    public function runBackup($token): bool
    {
        try {
            config([
                'database.connections.mysql.host' => '127.0.0.1',
                'database.connections.mysql.port' => '3308',
            ]);
            // Make API request to get products data
            $response = Http::withToken($token)->timeout(10)->get(config('app.api_url'));

            if (!$response->successful()) {
                Log::error('Backup failed: invalid response');
                return false;
            }

            $data = $response->json();

            // Start transaction to handle bulk database operations
            DB::transaction(function () use ($data) {
                foreach ($data['products'] as $product) {
                    // Insert or update product record
                    $newProduct = Product::updateOrCreate(
                        ['product_uuid' => $product['uid']],
                        [
                            'name' => $product['title'],
                            'product_handle' => $product['handle'],
                            'product_price' => $product['price'],
                            'created_at' => $product['created_at'],
                            'updated_at' => $product['updated_at']
                        ]
                    );

                    $this->handleVariants($product['variants'], $newProduct);
                    $this->handleProductImages($product['images'], $newProduct);
                }
            });

            Log::info('Backup completed successfully.');
            return true;
        } catch (Exception $e) {
            Log::error('Backup Exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Handle the variants of a product.
     *
     * @param array $variants
     * @param Product $newProduct
     * @return void
     */
    private function handleVariants(array $variants, Product $newProduct): void
    {
        $variantData = [];

        foreach ($variants as $variant) {
            if (empty($variant['uid'])) {
                Log::warning("Variant without UID skipped: " . json_encode($variant));
                continue;
            }

            // Prepare variant data for bulk insert
            $variantData[] = [
                'variant_uuid' => $variant['uid'],
                'product_id' => $newProduct->id,
                'product_uuid' => $newProduct->product_uuid,
                'variant_price' => $variant['price'],
                'variant_handle' => $variant['handle'],
                'variant_image_id' => $variant['image_id'] ?? null,
                'created_at' => $variant['created_at'],
                'updated_at' => $variant['updated_at']
            ];
        }

        // Bulk insert variants and variant images
        if (!empty($variantData)) {
            Variant::insert($variantData);
        }
    }

    /**
     * Handle product images.
     *
     * @param array $images
     * @param Product $newProduct
     * @return void
     */
    private function handleProductImages(array $images, Product $newProduct): void
    {
        $productImageData = [];

        foreach ($images as $image) {
            $productImageData[] = [
                'product_id' => $newProduct->id,
                'product_uuid' => $newProduct->product_uuid,
                'url' => $image['url'],
                'created_at' => $image['created_at'],
                'updated_at' => $image['updated_at']
            ];
        }

        // Bulk insert product images
        if (!empty($productImageData)) {
            ProductImage::insert($productImageData);
        }
    }
}
