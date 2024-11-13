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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('ruangan_id');
            $table->string('buktiTransaksi', 100);
            $table->string('uploadKopSurat', 100)->nullable();
            $table->enum('status', ['setujui', 'tolak', 'menunggu'])->default('menunggu');
            $table->date('tanggal_booking');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jadwal_id')->references('id')->on('jadwals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ruangan_id')->references('id')->on('ruangans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
