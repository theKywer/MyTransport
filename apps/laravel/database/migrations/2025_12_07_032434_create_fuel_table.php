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
        Schema::create('fuel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transport_id')
                ->references('id')
                ->on('transport')
                ->onDelete('cascade');
            $table->integer('mileage');
            $table->decimal('amount', 4, 2);
            $table->boolean('is_full');
            $table->decimal('price', 8, 2);
            $table->decimal('total', 8, 2);
            $table->integer('station_id');
            $table->timestamps();

            $table->index(['transport_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel');
    }
};
