<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow', function (Blueprint $table) {
            $table->increments('id');
            $table->string('b_code_borrow', 15)->nullable()->unique()->index();
            $table->integer('b_reader_id')->unsigned();
            $table->foreign('b_reader_id')->references('id')->on('reader')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('b_note')->nullable();
            $table->tinyInteger('b_status')->default(1);
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
        Schema::dropIfExists('borrow');
    }
}
