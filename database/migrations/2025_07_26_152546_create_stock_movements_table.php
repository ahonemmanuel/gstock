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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->dateTime('movement_date');
            $table->enum('type', ['entree', 'sortie', 'transfert', 'ajustement']);
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity');
            $table->string('source_location')->nullable();
            $table->string('destination_location')->nullable();
            $table->string('responsible');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
