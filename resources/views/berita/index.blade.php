@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
  .navbar-custom {
    background-color: #ffffff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    padding: 0.75rem 1.5rem;
    font-family: 'Poppins', sans-serif;
    position: sticky;
    top: 0;
    z-index: 1030;
  }
  .navbar-custom .navbar-brand {
    font-weight: 700;
    font-size: 1.5rem;
    color: #111827;
    text-decoration: none;
    user-select: none;
    letter-spacing: 0.05em;
  }
  .navbar-custom .navbar-nav .nav-link {
    color: #6b7280;
    font-weight: 500;
    font-size: 1rem;
    transition: color 0.3s ease;
    padding: 0.5rem 1rem;
  }
  .navbar-custom .navbar-nav .nav-link:hover,
  .navbar-custom .navbar-nav .nav-link:focus {
    color: #111827;
    text-decoration: none;
  }

  .container-custom {
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
  }

  h1 {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 3rem;
    color: #111827;
    margin-bottom: 1rem;
  }

  .card {
    border-radius: 0.75rem;
    box-shadow: 0 1px 6px rgb(0 0 0 / 0.1);
  }

  .card-title {
    font-weight: 600;
    color: #111827;
  }

  .card-text {
    color: #6b7280;
    overflow: hidden;
    position: relative;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    max-height: 8em;
  }

  .card-text.expanded {
    display: block;
    max-height: none;
  }

  .berita-card-body {
    display: flex;
    flex-direction: row;
    gap: 1.25rem;
    align-items: flex-start;
  }

  .berita-images {
    flex-shrink: 0;
    width: 250px;
    height: 160px;
    overflow: hidden;
  }

  .berita-images img {
    border-radius: 0.75rem;
    object-fit: cover;
    width: 100%;
    height: 100%;
    display: block;
  }

  .berita-content {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
  }

  .selengkapnya-btn {
    background: none;
    border: none;
    color: #0d6efd;
    padding: 0;
    font-size: 0.9rem;
    cursor: pointer;
    margin-top: 0.5rem;
    align-self: start;
  }

  .card-text a {
    color: #0d6efd;
    text-decoration: underline;
    word-break: break-word;
  }

  @media (max-width: 767.98px) {
    .berita-card-body {
      flex-direction: column;
    }
    .berita-images {
      width: 100%;
      height: auto;
    }
    .berita-images img {
      max-height: 250px;
      width: 100%;
    }
  }

  .welcome-text {
  font-size: 1.75rem; /* Lebih besar dari brand */
  font-weight: 700;
  color: #111827;
  white-space: nowrap;
}

        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f2f5; /* Contoh background keseluruhan halaman */
        }

        h1 {
            /* Gaya untuk background putih */
            background-color: white;
            padding: 15px 25px; /* Jarak di dalam kotak background */
            border-radius: 8px; /* Sudut membulat */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
            display: inline-block; /* Agar background hanya selebar teks */
            margin-bottom: 30px; /* Jarak di bawah judul */
            text-align: center; /* Untuk menengahkan teks judul */
            width: fit-content; /* Background selebar konten */
            margin-left: auto; /* Untuk menengahkan blok h1 */
            margin-right: auto; /* Untuk menengahkan blok h1 */
        }
</style>

<nav class="navbar navbar-custom">
  <div class="container-custom d-flex justify-content-between align-items-center">

    <div class="d-flex align-items-center gap-4 flex-grow-1">
      @auth
      <span class="welcome-text me-4">Welcome, {{ Auth::user()->name }}</span>
      @endauth
      <a href="{{ url('/') }}" class="navbar-brand">Portal Berita</a>
    </div>

    <ul class="navbar-nav d-flex flex-row gap-3 mb-0">
      @auth
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
      </li>
      @endauth
    </ul>

  </div>
</nav>


<div class="container container-custom py-4">
  <h1>Portal Berita</h1>
  @auth
  <a href="{{ route('berita.create') }}" class="btn btn-primary mb-3">Tambah Berita</a>
  @endauth
  <hr>
  @foreach ($beritas as $berita)
  <div class="card mb-4">
    <div class="berita-card-body">
      @if($berita->images && $berita->images->count() > 0)
      <div class="berita-images" aria-label="Images for {{ $berita->judul }}">
        @foreach ($berita->images as $image)
          <img src="{{ asset('storage/' . $image->path) }}" alt="Gambar {{ $berita->judul }}" />
        @endforeach
      </div>
      @elseif($berita->gambar)
      <div class="berita-images" aria-label="Image for {{ $berita->judul }}">
        <img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}" />
      </div>
      @endif

      <div class="berita-content">
        <h5 class="card-title">{{ $berita->judul }}</h5>
        <div class="card-text-wrapper">
          <p class="card-text">{!! nl2br(e($berita->konten)) !!}</p>
        </div>
        <button class="selengkapnya-btn" aria-expanded="false" aria-controls="content-{{ $berita->id }}">Selengkapnya</button>
        @auth
        <div class="mt-auto">
          <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning me-2">Edit</a>
          <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
          </form>
        </div>
        @endauth
      </div>
    </div>
  </div>
  @endforeach
</div>

<script>
  document.querySelectorAll('.selengkapnya-btn').forEach(button => {
    button.addEventListener('click', function () {
      // Cari elemen p.card-text di dalam parent container card-text-wrapper yang sama dengan tombol ini
      const cardText = this.parentElement.querySelector('.card-text');
      cardText.classList.toggle('expanded');
      this.textContent = cardText.classList.contains('expanded') ? 'Sembunyikan' : 'Selengkapnya';
      // Update aria-expanded untuk aksesibilitas
      this.setAttribute('aria-expanded', cardText.classList.contains('expanded'));
    });
  });
</script>

@endsection

