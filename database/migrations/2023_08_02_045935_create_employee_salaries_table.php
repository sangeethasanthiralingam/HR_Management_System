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
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->decimal('epf', 10, 2); // The 'decimal' method takes precision and scale as arguments.
            $table->decimal('etf', 10, 2); // Here, I assumed a precision of 10 and scale of 2. You can adjust as needed.
            $table->string('status');
            $table->decimal('salary_amount', 10, 2);
            $table->unsignedBigInteger('added_by');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('approved_by');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
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
