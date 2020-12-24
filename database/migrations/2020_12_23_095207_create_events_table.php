<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('blog_title')->nullable();
            $table->string('slug')->unique();
            $table->string('story');
            $table->string('date');
            $table->string('location');
            $table->integer('registrant_count')->default(0);
            $table->integer('share_count')->default(0);
            $table->string('registration_type')->nullable();
            $table->integer('no_of_tickets')->default(0);
            $table->float('ticket_price')->default(0);
            $table->text('feature_image')->nullable();
            $table->text('images')->nullable();
            $table->string('label')->nullable();
            $table->text('share_content')->nullable();
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
        Schema::dropIfExists('events');
    }
}
