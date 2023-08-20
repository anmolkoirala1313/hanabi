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
            $table->string('what_heading1')->nullable();
            $table->string('what_heading2')->nullable();
            $table->string('what_heading3')->nullable();
            $table->string('what_heading4')->nullable();
            $table->string('what_heading5')->nullable();
            $table->string('what_image1')->nullable();
            $table->string('what_image2')->nullable();
            $table->string('what_image3')->nullable();
            $table->string('what_image4')->nullable();
            $table->string('what_image5')->nullable();

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
            $table->dropColumn('what_heading1');
            $table->dropColumn('what_heading2');
            $table->dropColumn('what_heading3');
            $table->dropColumn('what_heading4');
            $table->dropColumn('what_heading5');
            $table->dropColumn('what_image1');
            $table->dropColumn('what_image2');
            $table->dropColumn('what_image3');
            $table->dropColumn('what_image4');
            $table->dropColumn('what_image5');

        });
    }
};
