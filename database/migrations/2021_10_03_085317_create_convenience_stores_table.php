<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvenienceStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenience_stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('convenience_store_category_id')->unsigned()->default(1);
            $table->foreign('convenience_store_category_id')->references('id')->on('convenience_store_categories')->onDelete('cascade');
            $table->string('address')->unique();
            $table->float('latitude');
            $table->float('longitude');
            $table->string('img_path')->nullable();
            $table->text('pr')->nullable();
            $table->boolean('toilet');
            $table->integer('parking');
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
        Schema::dropIfExists('convenience_stores');
    }
}
