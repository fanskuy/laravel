<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->integer('like')->default(0);
            $table->json('user_like')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('album_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fotos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['album_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('album_id');
            $table->dropColumn('like');
            $table->dropColumn('user_like');
        });
    }
};
