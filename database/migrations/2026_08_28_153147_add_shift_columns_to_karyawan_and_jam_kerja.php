<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->enum('jenis_shift', ['Non-Shift', 'Shift 1', 'Shift 2', 'Shift 3'])->default('Non-Shift')->after('jabatan');
        });

        Schema::table('konfigurasi_jam_kerja', function (Blueprint $table) {
            $table->string('nama_shift')->default('Non-Shift')->after('id');
        });

        // Seed data for the other 3 shifts
        DB::table('konfigurasi_jam_kerja')->insert([
            ['nama_shift' => 'Shift 1', 'jam_masuk' => '07:00:00', 'jam_pulang' => '15:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['nama_shift' => 'Shift 2', 'jam_masuk' => '15:00:00', 'jam_pulang' => '23:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['nama_shift' => 'Shift 3', 'jam_masuk' => '23:00:00', 'jam_pulang' => '07:00:00', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        // Remove the seeded data
        DB::table('konfigurasi_jam_kerja')->whereIn('nama_shift', ['Shift 1', 'Shift 2', 'Shift 3'])->delete();

        Schema::table('konfigurasi_jam_kerja', function (Blueprint $table) {
            $table->dropColumn('nama_shift');
        });

        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropColumn('jenis_shift');
        });
    }
};
