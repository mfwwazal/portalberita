<!DOCTYPE html>
<html>
<head>
    <title>Tambah Berita</title>
</head>
<body>
    <h2>Tambah Berita</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Judul:</label><br>
        <input type="text" name="judul" required><br><br>

        <label>Konten:</label><br>
        <textarea name="konten" rows="5" required></textarea><br><br>

        <label>Gambar (opsional):</label><br>
        <input type="file" name="gambar" accept="image/*"><br><br>

        <button type="submit">Simpan</button>
        <a href="{{ route('berita.index') }}">Batal</a>
    </form>
</body>
</html>
