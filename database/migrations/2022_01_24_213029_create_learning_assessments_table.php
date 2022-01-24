<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_assessments', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('learning_category_id');
            $table->unsignedBigInteger('learning_module_id')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('first_name')->nullable();
            $table->string('cohort')->nullable();
            $table->string('business')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('location')->nullable();
            $table->string('gender')->nullable();
            $table->string('value_chain')->nullable();
            $table->string('focus_area')->nullable();
            $table->string('score')->nullable();
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
        Schema::dropIfExists('learning_assessments');
    }
}
