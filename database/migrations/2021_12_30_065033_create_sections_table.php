<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('cover');
            $table->string('cover_url');
            $table->string('slug')->unique();

            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('section_id');

            $table->foreign('grade_id')->references('id')->on('grades');
            $table->foreign('section_id')->references('id')->on('sections');
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
        Schema::dropIfExists('sections');
    }
}
