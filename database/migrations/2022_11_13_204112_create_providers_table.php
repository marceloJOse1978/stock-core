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
        Schema::create('providers', function (Blueprint $table) {
            $table->increments("id");
            $table->string("code")->nullable(true);
            $table->string("reference")->nullable(true);
            $table->string("name");
            $table->string("email")->nullable(true);
            $table->string("address")->nullable(true);
            $table->string("city")->nullable(true);
            $table->string("code_postal")->nullable(true);
            $table->string("phone")->nullable(true);
            $table->string("mobile")->nullable(true);
            $table->string("country")->nullable(true);
            $table->string("website")->nullable(true);
            $table->string("send_mail")->nullable(true);
            $table->boolean("active")->default(true);
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
        Schema::dropIfExists('providers');
    }
};
