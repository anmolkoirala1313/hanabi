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
        Schema::table('homepages', function (Blueprint $table) {
            $table->string('project_completed')->nullable();
            $table->string('happy_clients')->nullable();
            $table->string('visa_approved')->nullable();
            $table->string('success_stories')->nullable();
            $table->string('why_heading')->nullable();
            $table->string('why_subheading')->nullable();
            $table->text('why_description')->nullable();
            $table->string('why_button')->nullable();
            $table->string('why_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homepages', function (Blueprint $table) {
            $table->dropColumn('project_completed');
            $table->dropColumn('happy_clients');
            $table->dropColumn('visa_approved');
            $table->dropColumn('success_stories');
            $table->dropColumn('why_heading');
            $table->dropColumn('why_subheading');
            $table->dropColumn('why_description');
            $table->dropColumn('why_button');
            $table->dropColumn('why_link');
        });
    }
};
