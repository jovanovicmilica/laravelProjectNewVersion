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
        Schema::create('supplier_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
            $table->foreignId('part_id')->nullable()->constrained('parts')->onDelete('set null');
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('priority')->nullable();
            $table->integer('days_valid')->nullable();
            $table->foreignId('condition_id')->nullable()->constrained('conditions')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_parts');
    }
};
