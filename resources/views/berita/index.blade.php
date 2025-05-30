@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Portal Berita</h1>
    @auth
    <a href="{{ route('berita.create') }}" class="btn btn-primary">Tambah Berita</a>
    @endauth
    <hr>
    @foreach ($beritas as $berita)
        <div class="card mb-3">
            @if($berita->gambar)
                <img src="{{ asset('storage/'.$berita->gambar) }}" class="card-img-top" alt="...">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $berita->judul }}</h5>
                <p class="card-text">{{ $berita->konten }}</p>
                @auth
                <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Hapus</button>
                </form>
                @endauth
            </div>
        </div>
    @endforeach
</div>
@endsection
