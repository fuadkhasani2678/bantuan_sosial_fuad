<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penilaian Penerima</title>

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
        label {
            font-weight: 600;
            color: #0056b3;
        }
        input:focus, textarea:focus, select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .form-control:hover {
            border-color: #007bff;
        }
        .form-icon {
            color: #007bff;
            margin-right: 8px;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-clipboard-check text-primary"></i> Tambah Penilaian untuk {{ $penerima->nama }}
            </h1>
            <a href="{{ route('penerima.show', $penerima) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card p-4">
            <form action="{{ route('assessment.store', $penerima) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="pendapatan_bulanan" class="form-label">
                        <i class="fas fa-money-bill-wave form-icon"></i> Pendapatan Bulanan (Rp)
                    </label>
                    <input type="number" class="form-control" id="pendapatan_bulanan" name="pendapatan_bulanan" required>
                    @error('pendapatan_bulanan') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="jumlah_tanggungan" class="form-label">
                        <i class="fas fa-users form-icon"></i> Jumlah Tanggungan
                    </label>
                    <input type="number" class="form-control" id="jumlah_tanggungan" name="jumlah_tanggungan" required>
                    @error('jumlah_tanggungan') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="kondisi_rumah" class="form-label">
                        <i class="fas fa-home form-icon"></i> Kondisi Rumah
                    </label>
                    <select class="form-select" id="kondisi_rumah" name="kondisi_rumah" required>
                        <option value="">Pilih</option>
                        <option value="Layak Huni">Layak Huni</option>
                        <option value="Kurang Layak">Kurang Layak</option>
                        <option value="Tidak Layak">Tidak Layak</option>
                    </select>
                    @error('kondisi_rumah') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">
                        <i class="fas fa-sticky-note form-icon"></i> Catatan (Opsional)
                    </label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                    @error('catatan') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="tanggal_penilaian" class="form-label">
                        <i class="fas fa-calendar-alt form-icon"></i> Tanggal Penilaian
                    </label>
                    <input type="date" class="form-control" id="tanggal_penilaian" name="tanggal_penilaian" required>
                    @error('tanggal_penilaian') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('penerima.show', $penerima) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
