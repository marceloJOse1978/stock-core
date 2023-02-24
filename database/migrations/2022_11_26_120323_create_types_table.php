<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments("id");
            $table->string("title"); 
            $table->boolean("on")->default(true);
            $table->integer("order")->nullable();
            $table->boolean("active")->default(true);
            $table->boolean("all_stores")->default(false);
            $table->string("products_order")->nullable();
            $table->string("kitchen_request")->nullable();
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
        Schema::dropIfExists('types');
    }
};
