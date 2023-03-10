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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("name_bs");
            $table->string("nif")->nullable();
            $table->string("address_bs")->nullable();
            $table->string("phone_bs")->nullable();
            $table->string("email_bs")->nullable();
            $table->string("coin")->default("kwanza");
            $table->text("text")->nullable();
            $table->string("pic_path")->nullable();
           
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
        Schema::dropIfExists('settings');
    }
};
