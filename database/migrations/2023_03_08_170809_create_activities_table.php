<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_kind_id');
            $table->unsignedBigInteger('benchmark_id')->nullable();
            $table->unsignedBigInteger('indicator_id')->nullable();
            $table->unsignedBigInteger('curator_id');
            $table->unsignedBigInteger('group_id');
            $table->dateTime('date');
            $table->string('threshold')->nullable();
            $table->string('assessment_frequency')->nullable();
            $table->string('possible_score');
            $table->integer('curator_score');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('activity_kind_id')->references('id')->on('activity_kinds')->onDelete('cascade');
            $table->foreign('benchmark_id')->references('id')->on('benchmarks')->onDelete('set null');
            $table->foreign('indicator_id')->references('id')->on('indicators')->onDelete('set null');
            $table->foreign('curator_id')->references('id')->on('curators')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
