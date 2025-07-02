<?php
namespace App\Http\Controllers;

use App\Models\AssessmentPenerima;
use App\Models\PenerimaBantuan;
use Illuminate\Http\Request;

class AssessmentPenerimaController extends Controller
{
    public function create(PenerimaBantuan $penerima)
    {
        return view('assessment.create', compact('penerima'));
    }

    public function store(Request $request, PenerimaBantuan $penerima)
    {
        $request->validate([
            'pendapatan_bulanan' => 'required|numeric|min:0',
            'jumlah_tanggungan' => 'required|integer|min:0',
            'kondisi_rumah' => 'required|in:Layak Huni,Kurang Layak,Tidak Layak',
            'catatan' => 'nullable|string',
            'tanggal_penilaian' => 'required|date',
        ]);

        $skor = 0;
        if ($request->pendapatan_bulanan <= 1000000) {
            $skor += 40;
        } elseif ($request->pendapatan_bulanan <= 2000000) {
            $skor += 20;
        }
        if ($request->jumlah_tanggungan >= 5) {
            $skor += 30;
        } elseif ($request->jumlah_tanggungan >= 3) {
            $skor += 15;
        }
        if ($request->kondisi_rumah == 'Tidak Layak') {
            $skor += 30;
        } elseif ($request->kondisi_rumah == 'Kurang Layak') {
            $skor += 15;
        }
        $kategori = match (true) {
            $skor >= 80 => 'Sangat Layak',
            $skor >= 50 => 'Layak',
            $skor >= 20 => 'Kurang Layak',
            default => 'Tidak Layak',
        };

        AssessmentPenerima::create([
            'penerima_id' => $penerima->id,
            'pendapatan_bulanan' => $request->pendapatan_bulanan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'kondisi_rumah' => $request->kondisi_rumah,
            'skor_kelayakan' => $skor,
            'kategori_kelayakan' => $kategori,
            'catatan' => $request->catatan,
            'tanggal_penilaian' => $request->tanggal_penilaian,
        ]);

        return redirect()->route('penerima.show', $penerima)->with('success', 'Penilaian berhasil ditambahkan.');
    }
}