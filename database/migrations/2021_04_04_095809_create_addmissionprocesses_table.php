<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddmissionprocessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addmissionprocesses', function (Blueprint $table) {
            $table->id();
            $table->string('college_id');
            $table->string('course_id');
            $table->text('admission_process');
            $table->text('admission_process_detail');
            $table->text('admission_process_link');
            $table->text('admission_process_link_text');
            $table->string('own_admission_process');
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
        Schema::dropIfExists('addmissionprocesses');
    }
}
