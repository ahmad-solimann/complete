<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_details', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('has_styles');
            $table->timestamps();
        });

        Schema::create('category_styles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('style_id');
            $table->timestamps();


            $table->foreign('category_id')
                ->references('id')
                ->on('category_details')
                ->onDelete('cascade');

            $table->foreign('style_id')
                ->references('id')
                ->on('styles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_details');
    }
}
