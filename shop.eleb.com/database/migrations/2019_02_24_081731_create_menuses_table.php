<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menuses', function (Blueprint $table) {
            $table->increments('id');               //主键
            $table->string('goods_name');          //名称
            $table->float('rating');               //评分
            $table->integer('shop_id');            //所属商家ID
            $table->integer('category_id');        //所属分类ID
            $table->float('goods_price');          //价格
            $table->string('description');         //描述
            $table->integer('month_sales');        //月销量
            $table->integer('rating_count');       //评分数量
            $table->string('tips');                 //提示信息
            $table->integer('satisfy_count');      //满意度数量
            $table->float('satisfy_rate');         //满意度评分
            $table->string('goods_img');          //商品图片
            $table->integer('status');             //状态：1上架，0下架
            $table->engine='InnoDB';
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
        Schemas::dropIfExists('menuses');
    }
}
