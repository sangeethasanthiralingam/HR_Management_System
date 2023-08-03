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
           
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
           
            $table->string('status');
            $table->decimal('salary_amount', 10, 2);
            $table->BigInteger('added_by')->unsigned()->nullable();;
            $table->foreign('added_by')->references('id')->on('users')->onDelete('set null');
            $table->BigInteger('approved_by')->unsigned()->nullable();;
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
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
