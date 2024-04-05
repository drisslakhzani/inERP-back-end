<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_requests', function (Blueprint $table) {
            $table->id();
            $table->json('sage');
            $table->boolean('sage_flag')->default(false); // Boolean flag for Sage
            $table->json('infrastructure');
            $table->boolean('infrastructure_flag')->default(false); // Boolean flag for Infrastructure
            $table->json('microsoft');
            $table->boolean('microsoft_flag')->default(false); // Boolean flag for Microsoft
            $table->json('material');
            $table->boolean('material_flag')->default(false); // Boolean flag for Material
            $table->foreignId('clients_id')->constrained()->cascadeOnDelete();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
