<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_courses', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('learning_module_id');
            $table->unsignedBigInteger('learning_category_id');
            $table->string('title');
            $table->binary('image')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('learning_courses');
    }
}
