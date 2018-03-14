<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUcUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uc_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('loginname',50)->comment('登陆账户');
            $table->string('password');
            $table->string('iphone',50)->nullable($value = true);
            $table->string('email')->nullable($value = true);;
            $table->string('uname')->nullable($value = true);;
            $table->string('img')->nullable($value = true);;
            $table->boolean('ustatus')->default(1);
            $table->string('salt')->nullable($value = true);
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
        Schema::dropIfExists('uc_user');
    }
}
