<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title",150); //标题
            $table->string("intro")->nullable();   //简介
            $table->string('author',100); //作者
            $table->boolean("comment_state")->default(1);//允许评论1|允许，2|不允许
            $table->string("icon",150)->nullable();   //封面
            $table->unsignedBigInteger("template_id")->default(0); //模板id,默认为0,0为默认模板
            $table->unsignedBigInteger("column_id"); //栏目id
            $table->unsignedBigInteger("category_id"); //分类id
            $table->string("source",100); //来源
            $table->text('content');  //内容
            $table->unsignedBigInteger("operator_id");  //操作者id
            $table->unsignedBigInteger("verifier_id")->default(0);  //审核者id
            $table->unsignedInteger("impression")->default('0');      //点击量
            $table->unsignedInteger("sort")->default(0); //排序默认为零
            $table->string('key_words', 150);//关键字集合
            $table->boolean("state")->default(1); //状态1草稿|2待审核|3已发布|4下架|5未通过
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
        Schema::dropIfExists('articles');
    }
}
