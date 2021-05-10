<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("type",2)->default("")->nullable(false)->comment('题目类型');
            $table->string("question",255)->default("")->nullable(false)->comment('问题');
            $table->tinyInteger('subject')->nullable(false)->comment('科目类别 1为科目一 4为科目四 默认1');
            $table->text('options')->nullable(false)->comment('答案选项');
            $table->string('answer',10)->nullable(false)->comment('答案');
            $table->text('explain')->nullable(false)->comment('解释');
            $table->string('pic',255)->nullable()->comment('图片');
            $table->string('question_type',50)->nullable(false)->comment('问题类型，如c1,c2,c3');
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
        Schema::dropIfExists('driver');
    }
}
