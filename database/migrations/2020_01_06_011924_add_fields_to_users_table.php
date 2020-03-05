<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('avatar_id')->comment('头像附件id')->after('password')->nullable();
            $table->boolean("sex")->comment('性别')->after('password')->nullable();
            $table->string('phone', 11)->comment("电话")->after('sex')->nullable();
            $table->string('address')->comment('地址')->after('phone')->nullable();
            $table->boolean('state')->comment('状态')->after('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['sex', 'phone', 'address','state','avatar_id']);
        });
    }
}
