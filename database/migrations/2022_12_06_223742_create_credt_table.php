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
        Schema::create('credt', function (Blueprint $table) {
            $table->increments("id");
            $table->string("title");
            $table->decimal("total",11,2);
            $table->decimal("paid",11,2)->nullable();
            $table->decimal("unpaid",11,2)->nullable();
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
        Schema::dropIfExists('credt');
    }
};