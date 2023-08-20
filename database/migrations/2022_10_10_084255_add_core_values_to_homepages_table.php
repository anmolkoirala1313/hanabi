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
            $table->string('core_main_heading')->nullable();
            $table->text('core_main_description')->nullable();
            $table->string('core_heading1')->nullable();
            $table->text('core_description1')->nullable();
            $table->string('core_heading2')->nullable();
            $table->text('core_description2')->nullable();
            $table->string('core_heading3')->nullable();
            $table->text('core_description3')->nullable();
            $table->string('core_heading4')->nullable();
            $table->text('core_description4')->nullable();
            $table->string('core_heading5')->nullable();
            $table->text('core_description5')->nullable();
            $table->string('core_heading6')->nullable();
            $table->text('core_description6')->nullable();
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
            $table->dropColumn('core_main_heading');
            $table->dropColumn('core_main_description');
            $table->dropColumn('core_heading1');
            $table->dropColumn('core_description1');
            $table->dropColumn('core_heading2');
            $table->dropColumn('core_description2');
            $table->dropColumn('core_heading3');
            $table->dropColumn('core_description3');
            $table->dropColumn('core_heading4');
            $table->dropColumn('core_description4');
            $table->dropColumn('core_heading5');
            $table->dropColumn('core_description5');
            $table->dropColumn('core_heading6');
            $table->dropColumn('core_description6');

        });
    }
};
