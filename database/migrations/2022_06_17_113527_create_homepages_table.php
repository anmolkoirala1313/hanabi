<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('welcome_heading')->nullable();
            $table->string('welcome_subheading')->nullable();
            $table->text('welcome_description')->nullable();
            $table->string('welcome_image')->nullable();
            $table->string('welcome_button')->nullable();
            $table->string('welcome_link')->nullable();
            $table->string('welcome_side_image')->nullable();
            $table->string('action_heading')->nullable();
            $table->string('action_button')->nullable();
            $table->string('action_link')->nullable();
            $table->string('action_heading2')->nullable();
            $table->string('action_button2')->nullable();
            $table->string('action_link2')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('homepages');
    }
}
