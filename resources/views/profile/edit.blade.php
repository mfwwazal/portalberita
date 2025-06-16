{{-- resources/views/profile/edit.blade.php --}}

@extends('layouts.app') {{-- Pastikan ini mengarah ke layout utama Anda --}}

@section('title', 'Edit Profil')

@section('content')
<style>
    /* Styling khusus untuk halaman edit profil (Anda bisa menyesuaikan dari profile.show) */
    .edit-profile-container {
        max-width: 700px;
        margin: 3rem auto;
        padding: 2.5rem;
        background-color: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #e0e7ff;
        animation: fadeInScale 0.6s ease-out;
    }

    /* Re-use fadeInScale from profile.show.blade.php or move it to a common CSS file */
    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.98);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .edit-profile-header {
        text-align: center;
        margin-bottom: 2rem;
        color: #1a202c;
        font-weight: 700;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #4b5563;
    }

    .form-control {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 1rem;
        box-sizing: border-box; /* Include padding in width */
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
        outline: none;
    }

    .btn-save-profile {
        background-color: #28a745; /* Green for save */
        color: #ffffff;
        padding: 0.8rem 2rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }

    .btn-save-profile:hover {
        background-color: #218838;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
    }

    .btn-cancel-profile {
        background-color: #6c757d; /* Gray for cancel */
        color: #ffffff;
        padding: 0.8rem 2rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        margin-left: 1rem;
    }

    .btn-cancel-profile:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
    }

    .invalid-feedback {
        color: #dc3545; /* Red for validation errors */
        font-size: 0.875em;
        margin-top: 0.25rem;
    }

    .current-profile-picture {
        display: block;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 3px solid #eee;
    }
</style>

<div class="edit-profile-container">
    <h2 class="edit-profile-header">Edit Profil Anda</h2>
    <hr>

    {{-- Menampilkan pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Menampilkan semua error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form untuk edit profil --}}
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        {{-- Jika menggunakan PUT/PATCH method di rute (salah satu saja): --}}
        {{-- @method('PUT') --}}
        {{-- atau --}}
        {{-- @method('PATCH') --}}


        <div class="form-group">
            <label for="name" class="form-label">Nama:</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Input untuk foto profil --}}
        <div class="form-group">
            <label for="profile_picture" class="form-label">Foto Profil:</label>
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Foto Profil Saat Ini" class="current-profile-picture">
                <p><small>Ganti foto profil Anda (maks 2MB).</small></p>
            @else
                <p><small>Belum ada foto profil. Unggah satu (maks 2MB).</small></p>
            @endif
            <input type="file" id="profile_picture" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror">
            @error('profile_picture')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Tambahkan field lain yang ingin diedit di sini jika Anda punya kolomnya di database --}}
        {{-- Contoh:
        <div class="form-group">
            <label for="address" class="form-label">Alamat:</label>
            <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $user->address) }}">
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        --}}

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn-save-profile">Simpan Perubahan</button>
            <a href="{{ route('profile.show') }}" class="btn-cancel-profile">Batal</a>
        </div>
    </form>
</div>
@endsection