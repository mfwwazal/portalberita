<!DOCTYPE html>
<html>
<head>
    <title>Edit Berita</title>
</head>
<body>
    <h2>Edit Berita</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Judul:</label><br>
        <input type="text" name="judul" value="{{ $berita->judul }}" required><br><br>

        <label>Konten:</label><br>
        <textarea name="konten" rows="5" required>{{ $berita->konten }}</textarea><br><br>

        <label>Gambar Baru (jika ingin ganti):</label><br>
        <input type="file" name="gambar" accept="image/*"><br><br>

        @if ($berita->gambar)
            <p>Gambar saat ini:</p>
            <img src="{{ asset('storage/' . $berita->gambar) }}" width="200"><br><br>
        @endif

        <button type="submit">Update</button>
        <a href="{{ route('berita.index') }}">Batal</a>
    </form>
</body>
</html>
