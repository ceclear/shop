<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->integer('classid')->nullable()->comment('分类id');
            $table->string('name','100')->nullable(false)->comment('名称')->index();
            $table->string('peoplenum',20)->comment('适用人数')->nullable()->default('');
            $table->string('preparetime',50)->comment('预备时间')->nullable()->default('');
            $table->string('cookingtime',50)->comment('亨饪时间')->nullable()->default('');
            $table->text('content')->comment('描述');
            $table->string('pic',255)->comment('图片')->nullable()->default('');
            $table->string('tag',500)->comment('标签')->nullable()->default('');
            $table->text('material')->comment('食材');
            $table->text('process')->comment('流程');
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
        Schema::dropIfExists('food');
    }
}
