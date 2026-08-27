<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KonfigurasiJamKerja;

class JamKerjaController extends Controller
{
    public function index()
    {
        $title = 'Konfigurasi Jam Kerja';
        $config = KonfigurasiJamKerja::first();

        if (!$config) {
            $config = KonfigurasiJamKerja::create([
                'jam_masuk' => '08:00:00',
                'jam_pulang' => '16:00:00'
            ]);
        }

        return view('admin.jam-kerja.index', compact('title', 'config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'jam_masuk' => 'required',
            'jam_pulang' => 'required'
        ]);

        $config = KonfigurasiJamKerja::first();
        if ($config) {
            $config->update([
                'jam_masuk' => $request->jam_masuk,
                'jam_pulang' => $request->jam_pulang
            ]);
        }

        return redirect()->back()->with('success', 'Konfigurasi jam kerja berhasil diperbarui!');
    }
}
