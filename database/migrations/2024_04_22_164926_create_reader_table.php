<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reader', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('r_department_id')->unsigned()->nullable();
            $table->integer('r_class_id')->unsigned()->nullable();
            $table->string('r_code_card', 15)->nullable()->unique()->index();
            $table->string('r_name')->index();
            $table->tinyInteger('r_gender')->default(0);
            $table->date('r_birthday')->nullable()->index();
            $table->string('r_address', 255)->nullable();
            $table->string('r_phone')->nullable();
            $table->string('r_avatar')->nullable();
            $table->integer('r_number_violations')->default(0);
            $table->date('r_card_created_date')->nullable();
            $table->date('r_card_expiry_date')->nullable();
            $table->tinyInteger('r_status')->default(1);
            $table->tinyInteger('r_card_status')->default(0);
            $table->foreign('r_department_id')->references('id')->on('department')
                ->onUpdate('cascade');
            $table->foreign('r_class_id')->references('id')->on('class')
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
        Schema::dropIfExists('reader');
    }
}
