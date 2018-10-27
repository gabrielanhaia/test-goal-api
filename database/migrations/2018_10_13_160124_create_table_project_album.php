<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProjectAlbum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_album', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('album_id')->unsigned();

            $table->foreign('project_id')
                ->references('id')->on('projects');

            $table->foreign('album_id')
                ->references('id')->on('albums');

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
        Schema::dropIfExists('project_album');
    }
}
