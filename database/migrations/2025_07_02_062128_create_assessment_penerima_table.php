<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_penerima', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerima_id')->constrained('penerima_bantuan')->onDelete('cascade');
            $table->decimal('pendapatan_bulanan', 15, 2);
            $table->integer('jumlah_tanggungan');
            $table->enum('kondisi_rumah', ['Layak Huni', 'Kurang Layak', 'Tidak Layak']);
            $table->integer('skor_kelayakan');
            $table->enum('kategori_kelayakan', ['Sangat Layak', 'Layak', 'Kurang Layak', 'Tidak Layak']);
            $table->text('catatan')->nullable();
            $table->date('tanggal_penilaian');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_penerima');
    }
};