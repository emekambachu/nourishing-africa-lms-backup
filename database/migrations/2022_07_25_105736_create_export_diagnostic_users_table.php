<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportDiagnosticUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_diagnostic_users', static function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('yaedp_user_id')->index();
            $table->integer('score')->default(0)->index();
            $table->integer('percent')->default(0)->index();
            $table->boolean('completed')->default(0);
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
        Schema::dropIfExists('export_diagnostic_users');
    }
}
