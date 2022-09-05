<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('isbn');
            $table->string('picture')->default('book-placeholder.png');
            $table->string('total_pages')->default('10');
            $table->integer('total_copies')->default(1);
            $table->foreignId('script_id')->constrained('scripts');
            $table->foreignId('language_id')->constrained('languages');
            $table->foreignId('cover_id')->constrained('covers');
            $table->foreignId('format_id')->constrained('formats');
            $table->foreignId('publisher_id')->constrained('publishers');
            $table->year('published_at')->default(date('Y'));
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
