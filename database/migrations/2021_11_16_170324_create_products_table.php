<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->required(); // 'code'=>'alpha'
            $table->string('name')->unique()->required();
            $table->text('description')->required();
            $table->string('brand')->required();
            $table->float('price', 8, 2)->required();
            $table->timestamps();
            $table->integer('category')->unsigned()->required();
            $table->foreign('category')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
