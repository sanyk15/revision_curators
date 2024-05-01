<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('surname')->nullable();
            $table->date('birth_date');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('citizenship')->nullable();
            $table->unsignedBigInteger('group_id');
            $table->boolean('is_head')->default(false);
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('students');
    }
}
