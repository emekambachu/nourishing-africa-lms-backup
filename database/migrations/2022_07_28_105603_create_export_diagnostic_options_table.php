<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportDiagnosticOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_diagnostic_options', static function (Blueprint $table){
            $table->id()->index();
            $table->unsignedBigInteger('export_diagnostic_category_id');
            $table->unsignedBigInteger('export_diagnostic_question_id');
            $table->string('option');
            $table->string('sort')->default(0);
            $table->string('points')->default(0);
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
        Schema::dropIfExists('export_diagnostic_options');
    }
}
