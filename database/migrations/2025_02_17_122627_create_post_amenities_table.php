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
        Schema::create('tb_tr_post_amenities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')
                ->references('id')
                ->on('tb_m_posts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('amenity_id')
                ->references('id')
                ->on('tb_m_amenities')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unique(['post_id', 'amenity_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_amenities');
    }
};
