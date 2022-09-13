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
            $table->foreignId('books_under_actions_id')->constrained('books_under_actions');
            $table->foreignId('librarian_id')->constrained('users');
            $table->foreignId('action_status_id')->constrained('book_action_statuses');
            $table->date('action_start')->default(date("Y-m-d"));
            $table->date('action_deadline');
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
