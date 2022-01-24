<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningAssignmentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_assignment_answers', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('learning_module_id')->nullable();
            $table->unsignedBigInteger('learning_category_id')->nullable();
            $table->unsignedBigInteger('learning_assignment_question_id');
            $table->string('answer')->nullable();
            $table->boolean('passed')->nullable();
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
        Schema::dropIfExists('learning_assignment_answers');
    }
}
