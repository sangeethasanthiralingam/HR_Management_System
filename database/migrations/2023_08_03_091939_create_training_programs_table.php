<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('location');
            $table->bigInteger('attendees')->unsigned()->nullable();
            $table->foreign('attendees')->references('id')->on('employees')->onDelete('set null');
            $table->bigInteger('instructor')->unsigned()->nullable();
            $table->foreign('instructor')->references('id')->on('instructors')->onDelete('set null');
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
        Schema::dropIfExists('training_programs');
    }
};
