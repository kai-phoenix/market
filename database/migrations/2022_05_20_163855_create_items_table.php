<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id',20);
            $table->unsignedBigInteger('user_id');
            $table->string('name',255);
            $table->string('description',1000);
            $table->unsignedBigInteger('category_id');
            $table->integer('price')->length(11);
            $table->string('image',100);
            $table->timestamps();
            
            //itemsのuser_idはusersのidに対し、外部キー制約を持つ(自動削除機能)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
