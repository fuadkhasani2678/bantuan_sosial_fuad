<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaBantuan extends Model
{
    use HasFactory;

    protected $table = 'penerima_bantuan';
    protected $fillable = ['nik', 'nama', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'status_bantuan'];

    public function assessments()
    {
        return $this->hasMany(AssessmentPenerima::class, 'penerima_id');
    }
}