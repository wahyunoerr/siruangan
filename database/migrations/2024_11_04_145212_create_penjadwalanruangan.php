<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjadwalanruangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ruangan_id');
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('event_id');
            $table->string('fasilitas', 100);
            $table->enum('status', ['Boking', 'Belum Diboking']);
            $table->enum('publish', ['published', 'dispublish']);
            $table->timestamps();

            $table->foreign('ruangan_id')->references('id')->on('ruangans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jadwal_id')->references('id')->on('jadwals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjadwalanruangan');
    }
};
