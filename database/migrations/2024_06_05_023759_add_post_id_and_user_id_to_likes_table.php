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
        Schema::table('likes', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->after('id'); // Voeg post_id kolom toe
            $table->unsignedBigInteger('user_id')->after('post_id'); // Voeg user_id kolom toe

            // Voeg eventuele foreign key constraints toe
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('saves', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->after('id'); // Voeg post_id kolom toe
            $table->unsignedBigInteger('user_id')->after('post_id'); // Voeg user_id kolom toe

            // Voeg eventuele foreign key constraints toe
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('likes', function (Blueprint $table) {
            // Drop de foreign keys als eerste
            $table->dropForeign(['post_id']);
            $table->dropForeign(['user_id']);
            
            // Drop de kolommen
            $table->dropColumn('post_id');
            $table->dropColumn('user_id');
        });

        Schema::table('saves', function (Blueprint $table) {
            // Drop de foreign keys als eerste
            $table->dropForeign(['post_id']);
            $table->dropForeign(['user_id']);
            
            // Drop de kolommen
            $table->dropColumn('post_id');
            $table->dropColumn('user_id');
        });
    }
};

