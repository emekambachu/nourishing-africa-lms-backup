<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningAssignmentQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_assignment_questions', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('learning_module_id');
            $table->unsignedBigInteger('learning_category_id');
            $table->string('question');
            $table->string('question_type');
            $table->string('option_one');
            $table->string('option_two');
            $table->string('option_three')->nullable();
            $table->string('option_four')->nullable();
            $table->string('option_five')->nullable();
            $table->string('option_six')->nullable();
            $table->string('answer');
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
        Schema::dropIfExists('learning_assignment_questions');
    }
}
