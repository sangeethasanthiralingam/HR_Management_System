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
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->id();
            $table->string('bio_code');
            $table->foreign('bio_code')->references('bio_code')->on('employees')->onDelete('cascade');
            $table->biginteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('setnull');
            $table->decimel('epf');
            $table->decimel('etf');
            $table->string('status');
            $table->decimel(salary_amount);
            $table->date('date');
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
        Schema::dropIfExists('employee_salaries');
    }
};
