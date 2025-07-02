<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penerima Bantuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8fbfd;
            color: #333;
            font-family: 'Segoe UI', sans-serif;
        }
        h1 {
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
            font-size: 0.9rem;
        }
        table tbody tr:hover {
            background-color: #f1f7ff;
            transition: 0.3s;
        }
        label {
            font-weight: 600;
        }
        .filter-toggle-btn {
            cursor: pointer;
            background-color: #f1f7ff;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            color: #007bff;
            transition: background-color 0.3s;
        }
        .filter-toggle-btn:hover {
            background-color: #007bff;
            color: white;
        }
        table {
            font-size: 0.85rem;
        }
        th, td {
            vertical-align: middle !important;
            padding: 8px 10px !important;
        }
        .aksi-btn {
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
        }
        .aksi-btn .btn {
            padding: 4px 8px;
            font-size: 0.75rem;
        }
    </style>

</head>
<body>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-hand-holding-heart text-primary"></i> Daftar Penerima Bantuan Sosial</h1>
            <div class="d-flex gap-2">
                <button class="filter-toggle-btn" onclick="toggleFilter()">
                    <i class="fas fa-filter"></i>
                </button>
                <a href="{{ route('penerima.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Tambah Penerima
                </a>
            </div>
        </div>

        <div id="filterSection" class="card p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5><i class="fas fa-filter text-primary"></i> Filter Data</h5>
                <button class="filter-toggle-btn" onclick="toggleFilter()">
                    <i class="fas fa-eye-slash"></i>
                </button>
            </div>
            <form method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Kategori Kelayakan</label>
                        <select name="kategori_kelayakan" class="form-select">
                            <option value="">Semua</option>
                            <option value="Sangat Layak" {{ request('kategori_kelayakan') == 'Sangat Layak' ? 'selected' : '' }}>Sangat Layak</option>
                            <option value="Layak" {{ request('kategori_kelayakan') == 'Layak' ? 'selected' : '' }}>Layak</option>
                            <option value="Kurang Layak" {{ request('kategori_kelayakan') == 'Kurang Layak' ? 'selected' : '' }}>Kurang Layak</option>
                            <option value="Tidak Layak" {{ request('kategori_kelayakan') == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Pendapatan Min (Rp)</label>
                        <input type="number" name="pendapatan_min" class="form-control" value="{{ request('pendapatan_min') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Pendapatan Max (Rp)</label>
                        <input type="number" name="pendapatan_max" class="form-control" value="{{ request('pendapatan_max') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jml Tanggungan (Min)</label>
                        <input type="number" name="jumlah_tanggungan" class="form-control" value="{{ request('jumlah_tanggungan') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Kondisi Rumah</label>
                        <select name="kondisi_rumah" class="form-select">
                            <option value="">Semua</option>
                            <option value="Layak Huni" {{ request('kondisi_rumah') == 'Layak Huni' ? 'selected' : '' }}>Layak Huni</option>
                            <option value="Kurang Layak" {{ request('kondisi_rumah') == 'Kurang Layak' ? 'selected' : '' }}>Kurang Layak</option>
                            <option value="Tidak Layak" {{ request('kondisi_rumah') == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
                        </select>
                    </div>
                    <div class="col-md-3 align-self-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search"></i> Filter
                        </button>
                        <a href="{{ route('penerima.index') }}" class="btn btn-secondary">
                            <i class="fas fa-sync"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card p-3">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th><i class="fas fa-id-card"></i> NIK</th>
                            <th><i class="fas fa-user"></i> Nama</th>
                            <th><i class="fas fa-calendar"></i> Tanggal Lahir</th>
                            <th><i class="fas fa-venus-mars"></i> Jenis Kelamin</th>
                            <th><i class="fas fa-map-marker-alt"></i> Alamat</th>
                            <th><i class="fas fa-toggle-on"></i> Status Bantuan</th>
                            <th><i class="fas fa-award"></i> Kategori Kelayakan</th>
                            <th><i class="fas fa-cogs"></i> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penerima as $item)
                            <tr>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->tanggal_lahir }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <span class="badge bg-{{ $item->status_bantuan == 'Aktif' ? 'success' : 'secondary' }}">
                                        {{ $item->status_bantuan }}
                                    </span>
                                </td>
                                <td>{{ $item->assessments->last()->kategori_kelayakan ?? '-' }}</td>
                                <td>
                                    <div class="aksi-btn">
                                        <a href="{{ route('penerima.show', $item) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('penerima.edit', $item) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('penerima.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($penerima->isEmpty())
                    <div class="text-center p-3 text-muted">
                        <i class="fas fa-info-circle"></i> Tidak ada data yang ditemukan.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleFilter() {
            const filter = document.getElementById('filterSection');
            if (filter.style.display === 'none') {
                filter.style.display = 'block';
            } else {
                filter.style.display = 'none';
            }
        }

        window.onload = () => {
            toggleFilter();
        };
    </script>
</body>
</html>
