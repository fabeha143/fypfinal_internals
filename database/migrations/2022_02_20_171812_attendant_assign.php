<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AttendantAssign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendant_assigns', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('attendant_primary')->constrained('employees');
            $table->foreignId('attendant_secondary')->constrained('employees');
            $table->foreignId('ward')->constrained('wards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
