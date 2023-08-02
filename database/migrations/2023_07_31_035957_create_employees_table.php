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

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('bio_code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dob_date');
            $table->string('gender');
            $table->string('mobile');
            $table->string('alternative_phone');
            $table->string('landline_number');
            $table->string('emergency_mobile');
            $table->string('email');
            $table->string('address');
            $table->string('blood');
            $table->string('nic');
            $table->string('passport_no');
            $table->bigInteger('company')->unsigned()->index()->nullable();
            $table->foreign('company')->references('id')->on('companies')->onDelete('set null');
            $table->bigInteger('position')->unsigned()->index()->nullable();
            $table->foreign('position')->references('id')->on('positions')->onDelete('set null');
            $table->bigInteger('department')->unsigned()->index()->nullable();
            $table->foreign('department')->references('id')->on('departments')->onDelete('set null');
            $table->string('basic_salary');
            $table->decimal('budgetary_relief');
            $table->date('hire_date');
            $table->boolean('has_shift');
            $table->string('ot_eligibility');
            $table->date('reg_hiredate');
            $table->string('locker_number');
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->string('img');
            $table->string('status');

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
        Schema::dropIfExists('employees');
    }
};
