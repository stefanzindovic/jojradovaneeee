<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('jmbg', 13)->unique();
            $table->string('username', 18)->unique();
            $table->string('picture')->default('profile-picture-placeholder.jpg');
            $table->foreignId('role_id')->constrained('user_roles');
            $table->boolean('is_active')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        // Create admin user
        $model = new \App\Models\User();
        $model->name = 'Administrator';
        $model->email = 'administrator@administrator.com';
        $model->jmbg = '0000000000000';
        $model->username = 'administrator';
        $model->role_id = 1;
        $model->email_verified_at = now();
        $model->password = \Illuminate\Support\Facades\Hash::make('admin123admin');
        $model->remember_token = Str::random(10);
        $model->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
