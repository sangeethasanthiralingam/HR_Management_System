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
        Schema::create('salary_advances', function (Blueprint $table) {
            $table->id();
            $table->string('bio_code');
            $table->decimal('amount_per_month', 8, 2);
            $table->string('type');
            $table->date('from_date');
            $table->date('to_date');
            $table->string('description');
            $table->timestamps();
    
            $table->foreign('bio_code')->references('bio_code')->on('employees')->onDelete('cascade');
        });
    }
    


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_advances');
    }
};
