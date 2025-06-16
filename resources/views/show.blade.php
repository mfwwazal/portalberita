@extends('layouts.app') {{-- Sesuaikan dengan layout utama Anda --}}

@section('title', 'Profil Saya')

@section('content')
<div class="container py-5">
    <h1>Profil Pengguna</h1>
    <hr>
    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    @if($user->profile_picture)
        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Foto Profil" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
    @else
        <p>Belum ada foto profil.</p>
    @endif

    {{-- Tambahkan link untuk edit profil jika diperlukan --}}
    <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit Profil</a>
</div>
@endsection