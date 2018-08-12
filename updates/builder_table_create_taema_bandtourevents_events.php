<?php namespace Taema\BandTourEvents\Updates;

use October\Rain\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateTaemaBandtoureventsEvents extends Migration
{
    public function up()
    {
        Schema::create('taema_bandtourevents_events', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->dateTime('datetime');
            $table->string('venue');
            $table->string('city');
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->longText('description')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tickets_url')->nullable();
            $table->boolean('published');
            $table->unsignedInteger('gallery_id')->nullable(); // Depends on RJ Gallery Plugin
            $table->timestamps();

            $table->foreign('gallery_id')
                ->references('id')
                ->on('raviraj_rjgallery_galleries');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('taema_bandtourevents_events');
    }
}
