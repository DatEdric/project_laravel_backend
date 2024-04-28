<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('at_name')->nullable();
            $table->string('at_email')->nullable();
            $table->string('at_phone')->nullable();
            $table->string('at_address')->nullable();
            $table->string('at_gender')->default(0)->nullable();
            $table->date('at_birthday')->nullable()->index();
            $table->tinyInteger('at_status')->default(1);
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
        Schema::dropIfExists('authors');
    }
}
