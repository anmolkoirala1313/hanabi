<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('slug')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('contact')->nullable();
            $table->text('address')->nullable();
            $table->enum('gender', ['male','female','others'])->default('others');
            $table->boolean('status')->default(0);
            $table->text('oauth_id')->nullable();
            $table->text('oauth_type')->nullable();
            $table->enum('user_type', ['admin','general','customer'])->default('general');
            $table->text('about')->nullable();
            $table->string('cover')->nullable();
            $table->text('fb')->nullable();
            $table->text('insta')->nullable();
            $table->text('twitter')->nullable();
            $table->text('linkedin')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
