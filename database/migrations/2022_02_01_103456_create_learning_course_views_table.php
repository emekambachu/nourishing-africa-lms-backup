<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningCourseViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_course_views', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('learning_module_id')->nullable();
            $table->unsignedBigInteger('learning_category_id')->nullable();
            $table->unsignedBigInteger('learning_course_id');
            $table->boolean('started_module')->default(1);
            $table->boolean('completed_module')->default(0);
            $table->boolean('started_course')->default(1);
            $table->boolean('completed_course')->default(0);
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
        Schema::dropIfExists('learning_course_views');
    }
}
