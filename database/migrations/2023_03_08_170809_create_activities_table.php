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
            $table->unsignedBigInteger('activity_kind_id')->nullable();
            $table->unsignedBigInteger('benchmark_id')->nullable();
            $table->unsignedBigInteger('indicator_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->dateTime('date');
            $table->string('threshold')->nullable();
            $table->string('assessment_frequency')->nullable();
            $table->string('possible_score')->nullable();
            $table->integer('curator_score')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('activity_kind_id')->references('id')->on('activity_kinds')->onDelete('set null');
            $table->foreign('benchmark_id')->references('id')->on('benchmarks')->onDelete('set null');
            $table->foreign('indicator_id')->references('id')->on('indicators')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('set null');
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
