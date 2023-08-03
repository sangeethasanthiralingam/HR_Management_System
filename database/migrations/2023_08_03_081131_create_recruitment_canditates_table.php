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
        Schema::create('recruitment_canditates', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('gender');
            $table->string('phone_no');
            $table->string('e_mail');
            $table->string('resume');
            $table->date('application_date');
        
            $table->bigInteger('position_applied_for')->unsigned()->nullable();
            $table->foreign('position_applied_for')->references('id')->on('positions')->onDelete('set null');
            $table->string('interview_status');
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
        Schema::dropIfExists('recruitment_canditates');
    }
};
