<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('product_uuid')->unique();
            $table->string('name');
            $table->string('product_handle')->nullable();
            $table->decimal('product_price', 10, 2)->nullable();
            $table->timestamps(); // includes created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
