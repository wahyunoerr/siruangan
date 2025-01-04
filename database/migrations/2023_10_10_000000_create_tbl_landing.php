<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblLanding extends Migration
{
    public function up()
    {
        Schema::create('tbl_landing', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('full_image');
            $table->string('description_image');
            $table->string('room_image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_landing');
    }
}
