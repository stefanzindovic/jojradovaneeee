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
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('variable');
            $table->integer('value')->default(20);
            $table->softDeletes();
            $table->timestamps();
        });

        $policies = [
            [
                'variable' => 'return_deadline',
                'value' => 30
            ],

            [
                'variable' => 'reservation_deadline',
                'value' => 15
            ],

            [
                'variable' => 'conflict_deadline',
                'value' => 15
            ],
        ];

        foreach ($policies as $policy) {
            $model = new \App\Models\Policy();

            $model->variable = $policy['variable'];
            $model->value = $policy['value'];

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
        Schema::dropIfExists('policies');
    }
};
