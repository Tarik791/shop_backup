<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    public function up(): void
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->uuid('variant_uuid')->unique();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->uuid('product_uuid');
            $table->string('variant_handle')->nullable();
            $table->decimal('variant_price', 10, 2)->nullable();
            $table->uuid('variant_image_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
}
