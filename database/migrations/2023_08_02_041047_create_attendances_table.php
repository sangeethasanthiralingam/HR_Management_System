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
            $table->string('code');
            $table->string('bio_code');
            $table->date('date');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->decimal('worked_hrs');
            $table->decimal('work_shift_tot_hrs');
            $table->string('status');



            $table->foreign('bio_code')->references('bio_code')->on('employees')->onDelete('cascade');

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
