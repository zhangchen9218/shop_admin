<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('col_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger("templ_type");
            $table->string('templ_uri',190);
            $table->boolean("state")->default(1);
            $table->unsignedBigInteger("column_id");
            $table->unsignedTinyInteger("limit")->default(10);
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
        Schema::dropIfExists('col_templates');
    }
}
