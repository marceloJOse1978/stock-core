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
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments("id");
            $table->foreignId("provider_id")->constrained("providers");
            $table->unsignedBigInteger("user_id");
            $table->string("number");
            $table->date("date");
            $table->string("pay")->default(true);
            $table->string("status")->default(false);
            $table->decimal("amount_gross",11,2)->default(0);
            $table->decimal("amount_net",11,2)->default(0);
            $table->decimal("amount_discount",11,2)->default(0);
            $table->string("discount")->default(0);
            $table->date("date_due");
            $table->text("observations")->nullable();
            $table->string("external_reference")->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
