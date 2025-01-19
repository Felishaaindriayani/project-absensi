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
        Schema::create('pengajuan_cutis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->date('tanggal_pengajuan');
            $table->enum('kategori_cuti', ['izin', 'cuti']);
            $table->time('tanggal_mulai');
            $table->time('tanggal_selesai');
            $table->text('alasan');
            $table->enum('status', ['menyetujui', 'tidak menyetujui']);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_cutis');
    }
};
