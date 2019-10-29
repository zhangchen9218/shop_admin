<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account',20);
            $table->string('password',100);
            $table->string('real_name', 50);
            $table->unsignedTinyInteger('role');
            $table->string('tel', 11);
            $table->unsignedTinyInteger("state");
            $table->string('login_ip', 32)->nullable();
            $table->string('login_token', 100)->nullable();
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
        Schema::dropIfExists('admins');
    }
}
