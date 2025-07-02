<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penerima Bantuan</title>

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
            <h1><i class="fas fa-user-plus text-primary"></i> Tambah Penerima Bantuan</h1>
            <a href="{{ route('penerima.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card p-4">
            <form action="{{ route('penerima.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nik" class="form-label"><i class="fas fa-id-badge form-icon"></i> NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" required>
                    @error('nik') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label"><i class="fas fa-user form-icon"></i> Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                    @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label"><i class="fas fa-calendar form-icon"></i> Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                    @error('tanggal_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label"><i class="fas fa-venus-mars form-icon"></i> Jenis Kelamin</label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">Pilih</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label"><i class="fas fa-map-marker-alt form-icon"></i> Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="status_bantuan" class="form-label"><i class="fas fa-toggle-on form-icon"></i> Status Bantuan</label>
                    <select class="form-select" id="status_bantuan" name="status_bantuan" required>
                        <option value="">Pilih</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                    @error('status_bantuan') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('penerima.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
