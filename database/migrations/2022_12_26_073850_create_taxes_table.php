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
        Schema::create('taxes', function (Blueprint $table) {
            $table->increments("id");
            $table->bigInteger("document_id")->nullable();
            $table->bigInteger("invoice_id")->nullable();
            $table->date("date");
            $table->boolean("active")->default(true);
            $table->decimal("percent")->nullable();
            $table->decimal("total",11,2)->nullable();
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
        Schema::dropIfExists('taxes');
    }
};
