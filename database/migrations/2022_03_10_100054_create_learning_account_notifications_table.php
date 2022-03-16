<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningAccountNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_account_notifications', static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('type')->nullable();
            $table->string('route')->nullable();
            $table->string('title');
            $table->string('description');
            $table->tinyInteger('opened')->default(0);
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
        Schema::dropIfExists('learning_account_notifications');
    }
}
