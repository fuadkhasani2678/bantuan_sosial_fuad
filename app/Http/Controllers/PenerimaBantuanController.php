<?php
namespace App\Http\Controllers;

use App\Models\PenerimaBantuan;
use App\Models\AssessmentPenerima;
use Illuminate\Http\Request;

class PenerimaBantuanController extends Controller
{
    public function index(Request $request)
    {
        $query = PenerimaBantuan::with('assessments');

        $query->when($request->filled('kategori_kelayakan'), function ($q) use ($request) {
            $q->whereHas('assessments', function ($subQuery) use ($request) {
                $subQuery->where('kategori_kelayakan', $request->kategori_kelayakan);
            });
        });

        $query->when($request->filled('pendapatan_min') && $request->filled('pendapatan_max'), function ($q) use ($request) {
            $q->whereHas('assessments', function ($subQuery) use ($request) {
                $subQuery->whereBetween('pendapatan_bulanan', [$request->pendapatan_min, $request->pendapatan_max]);
            });
        });

        $query->when($request->filled('jumlah_tanggungan'), function ($q) use ($request) {
            $q->whereHas('assessments', function ($subQuery) use ($request) {
                $subQuery->where('jumlah_tanggungan', '>=', $request->jumlah_tanggungan);
            });
        });

        $query->when($request->filled('kondisi_rumah'), function ($q) use ($request) {
            $q->whereHas('assessments', function ($subQuery) use ($request) {
                $subQuery->where('kondisi_rumah', $request->kondisi_rumah);
            });
        });

        $penerima = $query->get();
        return view('penerima.index', compact('penerima'));
    }

    public function create()
    {
        return view('penerima.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:penerima_bantuan',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'status_bantuan' => 'required|in:Aktif,Tidak Aktif',
        ]);

        PenerimaBantuan::create($request->all());
        return redirect()->route('penerima.index')->with('success', 'Data penerima berhasil ditambahkan.');
    }

    public function show(PenerimaBantuan $penerima)
    {
        $penerima->load('assessments');
        return view('penerima.show', compact('penerima'));
    }

    public function edit(PenerimaBantuan $penerima)
    {
        return view('penerima.edit', compact('penerima'));
    }

    public function update(Request $request, PenerimaBantuan $penerima)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:penerima_bantuan,nik,' . $penerima->id,
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'status_bantuan' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $penerima->update($request->all());
        return redirect()->route('penerima.index')->with('success', 'Data penerima berhasil diperbarui.');
    }

    public function destroy(PenerimaBantuan $penerima)
    {
        $penerima->delete();
        return redirect()->route('penerima.index')->with('success', 'Data penerima berhasil dihapus.');
    }
}