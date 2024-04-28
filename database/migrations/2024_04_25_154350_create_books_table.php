<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('b_categories_id')->unsigned();
            $table->integer('b_publishing_company_id')->unsigned();
            $table->string('b_name')->nullable();
            $table->text('b_description')->nullable();
            $table->string('b_image')->nullable();
            $table->string('b_code_book', 15)->nullable()->unique()->index();
            $table->integer('b_amount_liquidated')->nullable()->default('0');
            $table->double('b_price')->nullable()->default('0');
            $table->tinyInteger('b_status')->default(1);
            $table->foreign('b_categories_id')->references('id')->on('categories')
                ->onUpdate('cascade');
            $table->foreign('b_publishing_company_id')->references('id')->on('publishing_company')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('books');
    }
}
