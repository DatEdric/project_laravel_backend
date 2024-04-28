<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('d_borrow_id')->unsigned();
            $table->foreign('d_borrow_id')->references('id')->on('borrow')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('d_book_id')->unsigned();
            $table->foreign('d_book_id')->references('id')->on('books')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('d_reader_id')->unsigned();
            $table->integer('d_number')->default(1);
            $table->date('d_expiry_date')->nullable();
            $table->string('d_note')->nullable();
            $table->double('d_forfeit')->nullable();
            $table->tinyInteger('d_status')->default(1);
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
        Schema::dropIfExists('orders');
    }
}
