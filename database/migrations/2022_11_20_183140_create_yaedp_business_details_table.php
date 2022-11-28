<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYaedpBusinessDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yaedp_business_details', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('yaedp_value_chain_id')->index();
            $table->string('name');
            $table->dateTime('date_of_establishment');
            $table->integer('years_of_operation');
            $table->text('physical_address');
            $table->string('online_address')->nullable();
            $table->integer('staff_size')->nullable();
            $table->longText('business_description')->nullable();
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
        Schema::dropIfExists('yaedp_business_details');
    }
}
