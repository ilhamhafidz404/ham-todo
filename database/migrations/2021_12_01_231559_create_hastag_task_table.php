<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHastagTaskTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up() {
    Schema::create('hastag_task', function (Blueprint $table) {
      $table->id();
      $table->foreignId('task_id');
      $table->foreignId('hastag_id');

      $table->foreign('task_id')
      ->references('id')
      ->on('tasks')->onDelete('cascade');
      $table->foreign('hastag_id')
      ->references('id')
      ->on('hastags')->onDelete('cascade');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down() {
    Schema::dropIfExists('hastag_task');
  }
}