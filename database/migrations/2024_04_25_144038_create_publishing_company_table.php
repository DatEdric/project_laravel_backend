<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishingCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishing_company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pc_name')->nullable();
            $table->string('pc_email')->unique()->nullable();
            $table->string('pc_phone')->nullable();
            $table->string('pc_address')->nullable();
            $table->tinyInteger('pc_status')->default(1);
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
        Schema::dropIfExists('publishing_company');
    }
}
