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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('bookName');
            $table->string('author');
            $table->date('publishTime');
            $table->unsignedInteger('stock');
            $table->string('type');
            $table->unsignedInteger('pages');
            $table->longText('description');
            $table->decimal('price', 10, 2);
            $table->string('image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
