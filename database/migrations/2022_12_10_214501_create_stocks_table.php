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
    **/
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("document_id");
            $table->foreignId("product_id")->constrained("products");
            $table->boolean("active")->default(true);
            $table->boolean("move")->default(true); #--- 0 SAIDA 1 ENTRADA MOVIMENTAÇÃO DE STOCK ---#
            $table->string("title")->nullable(); #--- Vendas saida & Compra entrada ---#
            $table->integer("qty")->default("1");
            $table->string("unit")->nullable();
            $table->decimal("discount_for_itens",11,2)->nullable();
            $table->string("tax")->nullable();
            $table->decimal("net_total",11,2)->default(0); #--- QUANTO VALE O PRODUTO ---#
            $table->decimal("gross_total",11,2)->default(0); #--- QUANTO CUSTO TUDO ---#
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
        Schema::dropIfExists('stocks');
    }
};
