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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('bio_code')->unsigned()->index()->nullable();;
            $table->foreign('bio_code')->references('id')->on('employees')->onDelete('set null');

            $table->bigInteger('employee')->unsigned()->index()->nullable();;
            $table->foreign('employee')->references('id')->on('employees')->onDelete('set null');

            $table->bigInteger('position')->unsigned()->index()->nullable();;
            $table->foreign('position')->references('id')->on('positions')->onDelete('set null');

            $table->bigInteger('leave_type')->unsigned()->index()->nullable();;
            $table->foreign('leave_type')->references('id')->on('allowed_leaves')->onDelete('set null');

            $table->date('request_on');
            $table->date('dates');
            $table->integer('days');
            $table->integer('reason');
            $table->integer('status');
            
            $table->bigInteger('approved_by')->unsigned()->index()->nullable();;
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');

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
        Schema::dropIfExists('leave_requests');
    }
};
