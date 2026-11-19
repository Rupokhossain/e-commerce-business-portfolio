<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brand_partners', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->string('website_url')->nullable();
            $table->string('specialty')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brand_partners');
    }
};