<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
              $table->unsignedbigInteger('id')->autoIncrement()->index();
              $table->boolean('has_parent')->default(0);
              $table->unsignedbigInteger('parent_id')->nullable();
              $table->boolean('has_child')->default(0);
              $table->string('title')->unique();
              $table->string('sys_title')->unique();
              $table->integer('is_default')->default(1);
              $table->string('icon')->default('fa-paperclip')->nullable();
              $table->integer('status')->default(1);
              $table->set('type', ['dev', 'user'])->default('user');
              $table->timestamps();
        });

        Schema::table('modules', function($table) {
            $table->foreign('parent_id')->references('id')->on('modules');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
