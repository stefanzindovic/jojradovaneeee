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
        Schema::create('book_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_under_action')->constrained('books_under_actions');
            $table->foreignId('librarian_id')->constrained('users');
            $table->foreignId('student_id')->constrained('users');
            $table->date('action_deadline')->default(date("Y-m-d"));
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
        Schema::dropIfExists('book_actions');
    }
};
