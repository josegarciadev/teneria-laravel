<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineProductLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_product_logs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('line_product_id');
            $table->foreign('line_product_id')
                    ->references('id')
                    ->on('line_products')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('line_product_scenes_id');
            $table->foreign('line_product_scenes_id')
                    ->references('id')
                    ->on('line_product_scenes')
                    ->onDelete('cascade');
            $table->integer('count');
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
        Schema::dropIfExists('line_product_logs');
    }
}
