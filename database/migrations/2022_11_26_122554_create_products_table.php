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
        Schema::create('products', function (Blueprint $table) {
            $table->increments("id");
            $table->string("order")->nullable();
            $table->string("reference")->nullable();
            $table->string("barcode")->nullable();
            $table->string("supplier_code")->nullable();
            $table->string("title");
            $table->string("description")->nullable();
            $table->boolean("include_description")->nullable();
            $table->decimal("supply_price")->nullable();
            $table->decimal("gross_price");
            $table->string("class_name")->nullable();
            $table->string("type_id")->nullable();
            $table->string("stock_control")->nullable();
            $table->string("stock_type")->nullable();
            $table->string("tax_id")->default("14");
            $table->string("tax_exemption")->nullable();
            $table->string("tax_exemption_law")->nullable();
            $table->string("status")->default(true);
            $table->boolean("active")->default(true);
            $table->string("stock")->nullable();//activo ou não
            $table->string("stock_alert")->nullable();
            $table->text("pic_path")->nullable();
            $table->unsignedBigInteger('unit_id')->default(1);
            $table->unsignedBigInteger('variant_id')->nullable()/* ->references('variants')->on('id') */;
            $table->unsignedBigInteger('category_id')->nullable()/* ->references('type')->on('id') */;
            $table->unsignedBigInteger('brand_id')->nullable()/* ->references('brands')->on('id') */;
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
        Schema::dropIfExists('products');
    }
};
