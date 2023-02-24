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
        Schema::create('payments', function (Blueprint $table) {
            $table->increments("id");
            $table->foreignId("method_id")->constrained("methods")->default(1);
            $table->foreignId("document_id")->constrained("documents")->cascadeOnDelete();
            $table->string("title")->default("Pagamento a Pronto");
            $table->decimal("amount",11,2);
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
        Schema::dropIfExists('payments');
    }
};
