<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            //required info
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('user_role')->default(User::USER_ROLE);
            $table->rememberToken();
            $table->timestamps();

             //detailed info
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('phone')->nullable();
            $table->string('emirates_national_id')->nullable();
            $table->tinyInteger('verified')->default(0);
            $table->string('city')->nullable();
        });
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
}
