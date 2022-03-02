<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InpatientPrescriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inpatient_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->bigInteger('patient_id');
            $table->bigInteger('doctor_id');
            $table->bigInteger('department_id');
            $table->bigInteger('ward_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->bigInteger('dose_frequency');
            $table->string('unit');
            $table->string('date')->default(null);
            $table->time('morning_time')->nullable();
            $table->time('evening_time')->nullable();
            $table->time('night_time')->nullable();
            $table->text('comment');
            $table->foreignId('medicines')->constrained('medicines');
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
