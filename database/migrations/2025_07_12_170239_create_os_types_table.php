<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('os_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->text('image_url')->nullable(); // sebelumnya mungkin: string('image_url', 255)
            // tambah ini juga
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('os_types');
    }
};
