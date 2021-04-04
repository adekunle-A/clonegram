<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //link this profile to a user since is 1vs1 relationship foreign key
            $table->string("title")->nullable();
            $table->text("description")->nullable();
            $table->string("url")->nullable();
            $table->string("image")->nullable();
            $table->timestamps();


            //adding index for searchability and for every foreign key
            $table-> index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
