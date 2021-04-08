<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegefacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collegefacilities', function (Blueprint $table) {
            $table->id();
             $table->string('college_id');
           
            $table->string('facilities_id');
            $table->string('college_area');
            $table->string('college_faculty');
            $table->text('facilities_detail');
            $table->string('college_established');
            
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
        Schema::dropIfExists('collegefacilities');
    }
}
