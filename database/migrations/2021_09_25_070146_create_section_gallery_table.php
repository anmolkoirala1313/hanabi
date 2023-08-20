<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_gallery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('filename');
            $table->text('resized_name');
            $table->text('original_name');
            $table->unsignedBigInteger('page_section_id');
            $table->unsignedBigInteger('upload_by')->nullable();
            $table->foreign('page_section_id')->references('id')->on('page_sections')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('upload_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('section_gallery');
    }
}
