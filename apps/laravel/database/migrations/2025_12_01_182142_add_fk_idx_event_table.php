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
        Schema::table('event', function (Blueprint $table) {
            $table->bigInteger('transport_id')
                ->unsigned()
                ->change();
            $table->index('transport_id');
            $table->foreign('transport_id')
                ->references('id')
                ->on('transport')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event', function (Blueprint $table) {
            $table->dropForeign('event_transport_id_foreign');
            $table->dropIndex('event_transport_id_index');
        });
    }
};
