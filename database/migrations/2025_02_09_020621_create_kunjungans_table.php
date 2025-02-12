<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_kunjungan');
            $table->string('nama');
            $table->string('npm')->nullable(); // hanya mahasiswa
            $table->string('fakultas')->nullable(); // hanya mahasiswa
            $table->string('prodi')->nullable(); // hanya mahasiswa
            $table->string('nik')->nullable(); // hanya umum
            $table->string('pekerjaan')->nullable(); // hanya umum
            $table->string('keperluan');
            $table->string('no_telp');
            $table->enum('jenis_pengunjung', ['mahasiswa', 'umum']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kunjungans');
    }
};
