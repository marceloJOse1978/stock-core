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
        Schema::create('items', function (Blueprint $table) {
            $table->increments("id");
            $table->foreignId("document_id")->constrained("documents")->cascadeOnDelete();
            $table->unsignedBigInteger("product_id");
            $table->string("reference")->nullable();
            $table->string("title")->nullable();
            $table->integer("qty")->default("1");
            $table->string("unit")->nullable();
            $table->decimal("discount_for_itens",11,2)->default(0);
            $table->decimal("impost",11,2)->nullable();
            $table->decimal("total_tax",11,2)->nullable();
            $table->string("tax")->nullable();
            $table->decimal("net_total",11,2)->default(0);
            $table->decimal("gross_total",11,2);
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
        Schema::dropIfExists('items');
    }
};
