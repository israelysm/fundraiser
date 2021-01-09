<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('blog_title')->nullable();
            $table->string('slug')->unique();
            $table->longText('story');
            $table->string('ending_date')->nullable();
            $table->integer('contributor_count')->default(0);
            $table->integer('share_count')->default(0);
            $table->float('amount', 8, 2)->default(0);
            $table->float('target_amount', 8, 2)->default(0);
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
        Schema::dropIfExists('campaigns');
    }
}
