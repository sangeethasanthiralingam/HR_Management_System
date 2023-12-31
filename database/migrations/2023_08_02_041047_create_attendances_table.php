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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee')->unsigned()->index()->nullable();;
            $table->foreign('employee')->references('id')->on('employees')->onDelete('set null');
            $table->date('date');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->decimal('worked_hrs');
            $table->decimal('work_shift_tot_hrs');
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
        Schema::dropIfExists('attendances');
    }
};
