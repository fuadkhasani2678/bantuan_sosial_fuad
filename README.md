# Aplikasi CRUD dan Assessment Penerima Bantuan Sosial

## 📌 Dibuat oleh: Fuad Khasani (STI202202678)

![Thumbnail](./thumbnail.png)

---

## 👋 Selamat Datang

Selamat datang di repositori **Aplikasi CRUD dan Assessment Penerima Bantuan Sosial**. Aplikasi ini dibangun menggunakan **Laravel 12** untuk membantu proses pendataan dan penilaian kelayakan penerima bantuan sosial. Sistem ini mempermudah input data penerima, melakukan penilaian otomatis berdasarkan kriteria tertentu, serta memfilter data sesuai kebutuhan.

---

## 🚀 Fitur Utama

- CRUD data penerima bantuan.
- Sistem penilaian kelayakan otomatis berdasarkan:
  - **Pendapatan bulanan**
  - **Jumlah tanggungan**
  - **Kondisi rumah**
- Kategori kelayakan: 
  - `Sangat Layak`, `Layak`, `Kurang Layak`, `Tidak Layak`
- Filtering data berdasarkan hasil penilaian.

---

## 🔢 Logika Penilaian

| **Kriteria**         | **Poin**                              |
|----------------------|---------------------------------------|
| **Pendapatan**       | ≤1.000.000 = 40, 1-2jt = 20, >2jt = 0 |
| **Tanggungan**       | ≥5 = 30, 3-4 = 15, <3 = 0             |
| **Kondisi Rumah**    | Tidak Layak = 30, Kurang = 15, Layak = 0 |

**Kategori Kelayakan:**
- **80-100** → Sangat Layak
- **50-79** → Layak
- **20-49** → Kurang Layak
- **0-19**  → Tidak Layak

---

## 🗄️ Skema Database

### 1. **Tabel penerima_bantuan**
| Kolom           | Tipe           | Keterangan                |
|-----------------|-----------------|---------------------------|
| id              | BigInt (PK)     | Auto increment            |
| nik             | String(16)      | Unique, NIK               |
| nama            | String(255)     | Nama penerima             |
| tanggal_lahir   | Date            |                           |
| jenis_kelamin   | Enum            | Laki-laki / Perempuan     |
| alamat          | Text            |                           |
| status_bantuan  | Enum            | Aktif / Tidak Aktif       |
| created_at      | Timestamp       |                           |
| updated_at      | Timestamp       |                           |

### 2. **Tabel assessment_penerima**
| Kolom               | Tipe             | Keterangan                    |
|---------------------|------------------|-------------------------------|
| id                  | BigInt (PK)      | Auto increment                |
| penerima_id         | Foreign Key      | Relasi ke penerima_bantuan    |
| pendapatan_bulanan  | Decimal(15,2)    |                               |
| jumlah_tanggungan   | Integer          |                               |
| kondisi_rumah       | Enum             | Layak, Kurang Layak, Tidak Layak |
| skor_kelayakan      | Integer          | 0 - 100                       |
| kategori_kelayakan  | Enum             | Sangat Layak, Layak, dst.     |
| catatan             | Text (nullable)  |                               |
| tanggal_penilaian   | Date             |                               |
| created_at          | Timestamp        |                               |
| updated_at          | Timestamp        |                               |

**Relasi:**  
`penerima_bantuan (1)` → `assessment_penerima (N)`

---


## 📁 Struktur Folder

```plaintext
.
├── app
│   ├── Http
│   │   └── Controllers
│   │       ├── PenerimaBantuanController.php
│   │       └── AssessmentPenerimaController.php
│   └── Models
│       ├── PenerimaBantuan.php
│       └── AssessmentPenerima.php
├── database
│   └── migrations
├── public
├── resources
│   └── views
│       ├── penerima
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       └── assessment
│           └── create.blade.php
├── routes
│   └── web.php
├── .env
├── composer.json
└── package.json


