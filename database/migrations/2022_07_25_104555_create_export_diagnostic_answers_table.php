<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportDiagnosticAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_diagnostic_answers', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('yaedp_user_id')->index();
            $table->unsignedBigInteger('export_diagnostic_question_id')->index();
            $table->unsignedBigInteger('export_diagnostic_user_id')->nullable();
            $table->string('answer');
            $table->integer('points')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learning_diagnostic_answers');
    }
}
