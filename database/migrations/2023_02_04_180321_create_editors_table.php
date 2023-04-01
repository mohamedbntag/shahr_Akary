<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('testimonial_id');
            $table->foreign('testimonial_id')->references('id')->on('testimonials')->onDelete('cascade');
            $table->string('publication_num');
            $table->string('publication_year');
            $table->string('editor_type');
            $table->string('against_name_editor');
            $table->string('favor_name_editor');
            $table->string('statement');
            $table->string('dept');
            $table->string('notes');
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
        Schema::dropIfExists('editors');
    }
}
