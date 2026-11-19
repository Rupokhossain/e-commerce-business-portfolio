<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client_name');
            $table->string('industry');
            $table->string('location')->nullable();
            $table->text('summary')->nullable();
            $table->text('challenge_solution')->nullable();
            $table->json('hardware_used')->nullable();
            $table->string('results_metric')->nullable();
            $table->string('image')->nullable();
            $table->string('deployed_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};