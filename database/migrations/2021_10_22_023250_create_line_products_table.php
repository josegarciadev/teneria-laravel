<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_products', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('product_provider_id');
            $table->foreign('product_provider_id')
                    ->references('id')
                    ->on('product_provider')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('line_id');
            $table->foreign('line_id')
                    ->references('id')
                    ->on('lines')
                    ->onDelete('cascade');
            $table->integer('stock');
            $table->boolean('delete')->default(false);
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
        Schema::dropIfExists('line_products');
    }
}
