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
        Schema::create('post_tag', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();

            // Cara 1
            // $table->foreignId('post_id');
            // $table->foreignId('tag_id');
            // $table->primary(['post_id', 'tag_id']);
            // // foreign key nya jadi jika postnya dihapus post_tagnya juga akan ikut terhapus
            // $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            // $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            // Cara 2
            $table->foreignId('post_id')->constrained('posts');
            $table->foreignId('tag_id')->constrained('tags');
            $table->primary(['post_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
};
