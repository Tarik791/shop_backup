<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Variant;
use Illuminate\Support\Facades\Log;

class ClearShopData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-shop-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate products, images, and variants tables to clear all dummy shop data.';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        Log::info("🧹 Start cleaning data...");
        config([
            'database.connections.mysql.host' => '127.0.0.1',
            'database.connections.mysql.port' => '3308',
        ]);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate
        Variant::truncate();
        ProductImage::truncate();
        Product::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Log::info("✅ Shop data successfully deleted.");
    }
}
?>