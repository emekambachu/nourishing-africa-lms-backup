<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYaedpProductParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yaedp_product_parameters', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('yaedp_value_chain_id')->index();
            $table->unsignedBigInteger('yaedp_product_detail_id')->index();
            $table->string('moisture_content')->nullable();
            $table->string('crude_fat')->nullable();
            $table->string('protein_content')->nullable();
            $table->string('oil_content')->nullable();
            $table->string('admixture')->nullable();
            $table->string('ffa')->nullable();
            $table->string('foreign_matters')->nullable();
            $table->string('fibre_content')->nullable();
            $table->string('volatile_oil_content')->nullable();
            $table->string('non_volatile_ether_extract')->nullable();
            $table->string('proximate_content')->nullable();
            $table->string('color')->nullable();
            $table->string('dry_matter')->nullable();
            $table->string('starch_yield')->nullable();
            $table->string('amylose_content')->nullable();
            $table->string('cynanide_content')->nullable();
            $table->string('flour_particle_size')->nullable();
            $table->string('nut_count')->nullable();
            $table->string('kor')->nullable();
            $table->string('defective_nuts')->nullable();
            $table->string('slaty')->nullable();
            $table->string('bean_count')->nullable();
            $table->string('mould')->nullable();
            $table->string('impurity')->nullable();
            $table->string('cluster_bean')->nullable();
            $table->string('broken_beans')->nullable();
            $table->string('float_rate')->nullable();
            $table->string('total_defective_grains')->nullable();
            $table->string('extraneous_matter')->nullable();
            $table->string('split_beans')->nullable();
            $table->string('microbes')->nullable();
            $table->string('aflatoxin')->nullable();
            $table->string('others')->nullable();
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
        Schema::dropIfExists('yaedp_product_parameters');
    }
}
