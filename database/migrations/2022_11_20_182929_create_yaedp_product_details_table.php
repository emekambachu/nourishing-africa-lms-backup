<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYaedpProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yaedp_product_details', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type');
            $table->unsignedBigInteger('yaedp_value_chain_id')->index();
            $table->string('source_of_material')->nullable();
            $table->boolean('originally_produced')->default(0);
            $table->boolean('nutrition_information_provided')->default(0);
            $table->boolean('how_to_prepare')->default(0);
            $table->string('weight_per_pack')->nullable();
            $table->string('weight_per_bag')->nullable();
            $table->string('capacity')->nullable();
            $table->string('packaging_method')->nullable();
            $table->string('quantity_available')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('yaedp_product_details');
    }
}
