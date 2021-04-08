<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosteles', function (Blueprint $table) {
            $table->id();
            $table->string('college_id');
            $table->string('hostel_name');
            $table->text('hostel_facility');
            $table->string('state_id');
            $table->string('city');
            $table->string('hostel_type');
            $table->text('address_detail');
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
        Schema::dropIfExists('hosteles');
    }
}
