<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('budget_name');
            $table->text('data')->nullable();
            $table->integer('entity_id')->unsigned()->index()->nullable();
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
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
        Schema::dropIfExists('budget_types');
    }
}
