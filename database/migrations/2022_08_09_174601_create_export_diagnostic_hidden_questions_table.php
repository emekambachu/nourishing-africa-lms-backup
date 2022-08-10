<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportDiagnosticHiddenQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_diagnostic_hidden_questions', static function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('yaedp_user_id');
            $table->unsignedBigInteger('export_diagnostic_question_id');
            $table->unsignedBigInteger('export_diagnostic_option_id');
            $table->string('questions')->nullable();
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
        Schema::dropIfExists('export_diagnostic_hidden_questions');
    }
}
