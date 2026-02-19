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
        Schema::table('users', function (Blueprint $table) {
            $table->string('login')->unique()->nullable()->after('email');
            $table->string('firstname')->nullable()->after('name');
            $table->string('secondname')->nullable()->after('firstname');
            $table->string('family')->nullable()->after('secondname');
            $table->string('phone')->nullable()->after('family');
            $table->string('birthday')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'login',
                'firstname',
                'secondname',
                'family',
                'phone',
                'birthday'
            ]);
        });
    }
};
