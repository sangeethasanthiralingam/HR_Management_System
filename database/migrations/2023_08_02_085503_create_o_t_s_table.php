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
        Schema::create('o_t_s', function (Blueprint $table) {
            $table->id();
            $table->decimal('etf');
            $table->bigInteger('employee')->unsigned()->nullable();
            $table->foreign('employee')->references('id')->on('employees')->onDelete('set null');
            $table->datetime('ot_hour');
            $table->decimal('hour_payment');
            $table->decimal('total');
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
        Schema::dropIfExists('o_t_s');
    }
};
