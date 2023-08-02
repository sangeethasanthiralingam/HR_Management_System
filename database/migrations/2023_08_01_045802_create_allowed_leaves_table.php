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
        Schema::create('allowed_leaves', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('position')->unsigned()->index()->nullable();
            $table->foreign('position')->references('id')->on('positions')->onDelete('set null');
             $table->bigInteger('type')->unsigned()->index()->nullable();
             $table->foreign('type')->references('id')->on('leave_types')->onDelete('set null');
            $table->string('term');
            $table->string('count');
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
        Schema::dropIfExists('allowed_leaves');
    }
};
