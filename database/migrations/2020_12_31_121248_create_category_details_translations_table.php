<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryDetailsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_details_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            // foreign key to the main model
            $table->unsignedBigInteger('category_details_id');
            $table->unique(['category_details_id', 'locale']);
            $table->foreign('category_details_id')
                ->references('id')
                ->on('category_details')
                ->onDelete('cascade');


            // Actual fields you want to translate
            $table->string('name');
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_details_translations');
    }
}
