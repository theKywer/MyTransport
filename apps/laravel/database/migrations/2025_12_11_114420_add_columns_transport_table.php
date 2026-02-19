<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transport', function (Blueprint $table) {
            $table->integer('mileage');
            $table->decimal('average_consumption');
        });
    }

    public function down(): void
    {
        Schema::table('transport', function (Blueprint $table) {
            $table->dropColumn('mileage');
            $table->dropColumn('average_consumption');
        });
    }
};
