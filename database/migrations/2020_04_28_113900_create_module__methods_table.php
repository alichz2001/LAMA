<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module__methods', function (Blueprint $table) {
            $table->unsignedbigInteger('id')->autoIncrement()->index();
            $table->unsignedbigInteger('module_id');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->unsignedbigInteger('method_id');
            $table->foreign('method_id')->references('id')->on('methods')->onDelete('cascade');
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
        Schema::dropIfExists('module__methods');
    }
}
