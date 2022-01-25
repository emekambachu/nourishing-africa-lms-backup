<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_modules', static function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('learning_category_id');
            $table->binary('image');
            $table->text('description');
            $table->string('start');
            $table->string('end');
            $table->boolean('visible')->default(1);
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
        Schema::dropIfExists('learning_modules');
    }
}
