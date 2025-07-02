<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penerima Bantuan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8fbfd;
            color: #333;
            font-family: 'Segoe UI', sans-serif;
        }
        h1, h3 {
            color: #0056b3;
            font-weight: 700;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary:hover {
            background-color: #6c757d;
        }
        table thead {
            background-color: #007bff;
            color: white;
        }
        table tbody tr:hover {
            background-color: #f1f7ff;
            transition: 0.3s;
        }
        .detail-item {
            margin-bottom: 0.5rem;
        }
        .detail-label {
            font-weight: 600;
            width: 180px;
            display: inline-block;
            color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-id-card text-primary"></i> Detail Penerima Bantuan</h1>
            <a href="{{ route('penerima.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card p-4 mb-4">
            <div class="mb-3">
                <div class="detail-item"><span class="detail-label"><i class="fas fa-id-badge"></i> NIK:</span> {{ $penerima->nik }}</div>
                <div class="detail-item"><span class="detail-label"><i class="fas fa-user"></i> Nama:</span> {{ $penerima->nama }}</div>
                <div class="detail-item"><span class="detail-label"><i class="fas fa-calendar"></i> Tanggal Lahir:</span> {{ $penerima->tanggal_lahir }}</div>
                <div class="detail-item"><span class="detail-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin:</span> {{ $penerima->jenis_kelamin }}</div>
                <div class="detail-item"><span class="detail-label"><i class="fas fa-map-marker-alt"></i> Alamat:</span> {{ $penerima->alamat }}</div>
                <div class="detail-item"><span class="detail-label"><i class="fas fa-toggle-on"></i> Status Bantuan:</span> 
                    <span class="badge bg-{{ $penerima->status_bantuan == 'Aktif' ? 'success' : 'secondary' }}">
                        {{ $penerima->status_bantuan }}
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3><i class="fas fa-history text-primary"></i> Riwayat Penilaian</h3>
                <a href="{{ route('assessment.create', $penerima) }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Tambah Penilaian
                </a>
            </div>

            @if ($penerima->assessments->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Belum ada data penilaian.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th><i class="fas fa-calendar-check"></i> Tanggal Penilaian</th>
                                <th><i class="fas fa-coins"></i> Pendapatan Bulanan</th>
                                <th><i class="fas fa-users"></i> Jml Tanggungan</th>
                                <th><i class="fas fa-home"></i> Kondisi Rumah</th>
                                <th><i class="fas fa-star"></i> Skor</th>
                                <th><i class="fas fa-award"></i> Kategori</th>
                                <th><i class="fas fa-comment-dots"></i> Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penerima->assessments as $assessment)
                                <tr>
                                    <td>{{ $assessment->tanggal_penilaian }}</td>
                                    <td>Rp {{ number_format($assessment->pendapatan_bulanan, 0, ',', '.') }}</td>
                                    <td>{{ $assessment->jumlah_tanggungan }}</td>
                                    <td>{{ $assessment->kondisi_rumah }}</td>
                                    <td>{{ $assessment->skor_kelayakan }}</td>
                                    <td>{{ $assessment->kategori_kelayakan }}</td>
                                    <td>{{ $assessment->catatan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
