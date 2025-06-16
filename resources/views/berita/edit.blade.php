<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Tambahkan Font Awesome untuk ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #343a40;
        }
        .error-message {
            color: red;
        }
        /* Kelas btn-custom Anda tidak digunakan di sini, tapi saya biarkan jika Anda punya tombol lain */
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        /* Tambahan styling untuk preview gambar dan tombolnya agar rapi */
        .image-preview-section {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            background-color: #f8f9fa;
            display: flex; /* Untuk mensejajarkan teks dan tombol */
            align-items: center; /* Untuk mensejajarkan secara vertikal */
            flex-wrap: wrap; /* Agar bisa wrap ke bawah di layar kecil */
        }
        .image-preview-section small {
            margin-right: 15px; /* Jarak antara teks dan tombol */
        }
        .image-thumbnail {
            max-width: 80px; /* Ukuran thumbnail kecil */
            height: auto;
            border-radius: 3px;
            margin-left: 10px; /* Jarak dari teks "Gambar saat ini:" */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Berita</h2>

        @if ($errors->any())
            <div class="alert alert-danger"> {{-- Menggunakan kelas Bootstrap untuk pesan error --}}
                <ul class="mb-0"> {{-- Menghilangkan margin bawah default ul --}}
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Berita:</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required>
            </div>

            <div class="mb-3">
                <label for="konten" class="form-label">Konten Berita:</label>
                <textarea class="form-control" id="konten" name="konten" rows="5" required>{{ old('konten', $berita->konten) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Baru (jika ingin ganti):</label>
                <input type="file" class="form-control" id="gambar" name="gambar"> {{-- Single file upload --}}
                @if ($berita->gambar)
                    <div class="image-preview-section">
                        <small class="form-text text-muted">Gambar saat ini:</small>
                        {{-- Opsional: Tampilkan thumbnail gambar --}}
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita Saat Ini" class="image-thumbnail">
                        <a href="{{ asset('storage/' . $berita->gambar) }}" target="_blank" class="btn btn-info btn-sm ms-3"> {{-- ms-3 untuk margin-start (kiri) --}}
                            <i class="fas fa-eye me-1"></i> Lihat Gambar {{-- Ikon mata --}}
                        </a>
                        <small class="form-text text-muted ms-3">Akan diganti jika Anda memilih file baru.</small>
                    </div>
                @else
                    <small class="form-text text-muted d-block mt-2">Belum ada gambar saat ini.</small>
                @endif
                @error('gambar')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Berita</button>
            <a href="{{ route('berita.index') }}" class="btn btn-secondary">Batal</a>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>