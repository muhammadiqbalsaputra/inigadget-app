<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('sku')->unique(); // ← Tambahan kolom SKU
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->string('image_url')->nullable();

            $table->foreignId('brand_id')
                  ->constrained('brands')
                  ->cascadeOnDelete();

            $table->foreignId('os_type_id')
                  ->constrained('os_types')
                  ->cascadeOnDelete();

            $table->boolean('is_active')->default(true); // ← Sudah ada

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};