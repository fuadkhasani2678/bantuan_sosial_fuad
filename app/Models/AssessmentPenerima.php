<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentPenerima extends Model
{
    use HasFactory;

    protected $table = 'assessment_penerima';
    protected $fillable = [
        'penerima_id',
        'pendapatan_bulanan',
        'jumlah_tanggungan',
        'kondisi_rumah',
        'skor_kelayakan',
        'kategori_kelayakan',
        'catatan',
        'tanggal_penilaian',
    ];

    public function penerima()
    {
        return $this->belongsTo(PenerimaBantuan::class, 'penerima_id');
    }
}