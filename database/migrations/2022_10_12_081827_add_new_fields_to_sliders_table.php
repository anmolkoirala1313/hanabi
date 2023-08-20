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
        Schema::table('sliders', function (Blueprint $table) {
            $table->text('slider_link')->after('status')->nullable();
            $table->string('caption2')->after('status')->nullable();
            $table->string('caption1')->after('status')->nullable();
            $table->string('link2')->after('status')->nullable();
            $table->string('button2')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn('slider_link');
            $table->dropColumn('caption2');
            $table->dropColumn('caption1');
            $table->dropColumn('link2');
            $table->dropColumn('button2');

        });
    }
};
