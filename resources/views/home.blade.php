<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Portal Berita</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>
  <header>
    <div class="logo">PORTAL<span>BERITA</span></div>
    <nav>
      <ul>
        <li><a href="/">Beranda</a></li>
        <li><a href="#">Nasional</a></li>
        <li><a href="#">Internasional</a></li>
        <li><a href="#">Teknologi</a></li>
        <li><a href="#">Olahraga</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <h1>Berita Utama Hari Ini</h1>
    <p>Ikuti perkembangan terbaru dari seluruh penjuru dunia.</p>
  </section>

  {{-- <section class="berita-grid">
    @foreach ($berita as $item)
    <article>
      <img src="{{ $item->gambar_url }}" alt="Gambar Berita">
      <h2>{{ $item->judul }}</h2>
      <p>{{ Str::limit($item->isi, 100) }}</p>
    </article>
    @endforeach
  </section> --}}

  <footer>
    <p>&copy; 2025 PortalBerita.co.id | Dibuat oleh Fawwaz</p>
  </footer>
</body>
</html>
