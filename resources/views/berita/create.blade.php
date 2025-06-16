@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

<div class="bg-white p-10 rounded-xl shadow-xl w-full max-w-lg mx-auto mt-10">
  <h1 class="text-4xl font-extrabold text-gray-900 mb-8">📰 Tambah Berita</h1>

  @if ($errors->any())
    <div class="mb-6 p-4 border border-red-300 bg-red-50 text-red-700 rounded-lg" role="alert">
      <ul class="list-disc list-inside space-y-1">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" novalidate>
    @csrf

    <div>
      <label for="judul" class="block text-lg font-semibold text-gray-700 mb-2">Judul</label>
      <input
        id="judul"
        name="judul"
        type="text"
        required
        value="{{ old('judul') }}"
        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900"
        placeholder="Masukkan judul berita"
      />
    </div>

    <div>
      <label for="konten" class="block text-lg font-semibold text-gray-700 mb-2">Konten</label>
      <textarea
        id="konten"
        name="konten"
        rows="6"
        required
        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 resize-y"
        placeholder="Masukkan isi berita secara lengkap"
      >{{ old('konten') }}</textarea>
    </div>

    <div>
  <label for="gambar" class="block text-lg font-semibold text-gray-700 mb-2">Gambar (opsional)</label>
  <input
    id="gambar"
    name="gambar"
    type="file"
    accept="image/jpeg,image/png,image/jpg,image/gif"
    class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 focus:outline-none"
  />
</div>

    <div class="flex items-center justify-between">
      <button
        type="submit"
        class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-lg font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
      >
        💾 Simpan
      </button>
      <a
        href="{{ route('berita.index') }}"
        class="text-indigo-600 hover:text-indigo-800 font-medium transition"
      >
        Batal
      </a>
    </div>
  </form>
</div>
@endsection
