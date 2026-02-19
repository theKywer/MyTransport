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
        Schema::table('event_resources', function (Blueprint $table) {
            $table->bigInteger('details_id')
                ->unsigned()
                ->change();
            $table->index('details_id');
            $table->foreign('details_id')
                ->references('id')
                ->on('event_details')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_resources', function (Blueprint $table) {
            $table->dropForeign('event_resources_details_id_foreign');
            $table->dropIndex('event_resources_details_id_index');
        });
    }
};
