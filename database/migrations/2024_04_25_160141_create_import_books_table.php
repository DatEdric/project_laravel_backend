<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ib_books_id')->unsigned()->nullable();
            $table->integer('ib_amount')->default('0');
            $table->integer('ib_issue_number')->nullable();
            $table->foreign('ib_books_id')->references('id')->on('books')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_books');
    }
}
