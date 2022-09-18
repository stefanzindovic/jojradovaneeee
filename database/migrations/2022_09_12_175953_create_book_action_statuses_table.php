<?php

use App\Models\BookActionStatus;
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
        Schema::create('book_action_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        $statuses = [
            'Izdata',
            'Rezervisana',
            'Rezervacija odobrena',
            'Rezervacija odbijena',
            'Rezervacija istekla',
            'Rezervacija otkazana',
            'Izdata po rezervaciji',
            'Otpisana',
            'Vraćena'
        ];

        foreach ($statuses as $status) {
            $model = new BookActionStatus();
            $model->name = $status;
            $model->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_action_statuses');
    }
};
