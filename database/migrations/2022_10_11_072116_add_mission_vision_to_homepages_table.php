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
            $table->string('mv_heading')->nullable();
            $table->string('mv_subheading')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->text('value')->nullable();
            $table->string('mv_image')->nullable();

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
            $table->dropColumn('mv_heading');
            $table->dropColumn('mv_subheading');
            $table->dropColumn('mission');
            $table->dropColumn('vision');
            $table->dropColumn('value');
            $table->dropColumn('mv_image');

        });
    }
};
