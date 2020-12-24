<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->unique();
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('photo')->nullable();
            $table->string('role')->default('user');
            $table->string('designation')->nullable();
            $table->text('bio')->nullable();
            $table->string('blood_group')->nullable();
            $table->text('address')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zip_code');
            $table->boolean('email_digest')->default(0);
            $table->boolean('news_letter')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('members');
    }
}
