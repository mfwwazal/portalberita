{{-- resources/views/settings/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@section('content')
<style>
    /* Basic container styling (from previous versions, ensure consistency) */
    .settings-container {
        max-width: 800px; /* Lebih lebar untuk menampung lebih banyak konten */
        margin: 3rem auto;
        padding: 2.5rem;
        background-color: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #e0e7ff;
        animation: fadeInScale 0.6s ease-out;
    }

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

    .settings-header {
        text-align: center;
        margin-bottom: 2rem;
        color: #1a202c;
        font-weight: 700;
    }

    /* Bootstrap overrides for tabs (optional, adjust if needed) */
    .nav-tabs .nav-link {
        color: #4b5563;
        font-weight: 600;
        border: none;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link.active {
        color: #4f46e5; /* Warna tema Anda */
        border-bottom-color: #4f46e5;
        background-color: transparent;
    }

    .nav-tabs .nav-link:hover {
        border-bottom-color: #a78bfa; /* Slightly lighter hover */
    }

    .tab-content .tab-pane {
        padding: 1.5rem 0;
    }

    /* Form and button styling (re-used from previous versions) */
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
        box-sizing: border-box;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
        outline: none;
    }

    .btn-primary-action { /* General primary button style */
        background-color: #4f46e5;
        color: #ffffff;
        padding: 0.8rem 2rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
    }

    .btn-primary-action:hover {
        background-color: #4338ca;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
    }

    .btn-danger-action { /* Specific style for delete button */
        background-color: #dc3545;
        color: #ffffff;
        padding: 0.8rem 2rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
    }

    .btn-danger-action:hover {
        background-color: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
    }


    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875em;
        margin-top: 0.25rem;
    }

    .alert {
        padding: 1rem;
        margin-bottom: 1.5rem;
        border: 1px solid transparent;
        border-radius: 0.5rem;
    }
    .alert-success {
        color: #0f5132;
        background-color: #d1e7dd;
        border-color: #badbcc;
    }
    .alert-danger {
        color: #842029;
        background-color: #f8d7da;
        border-color: #f5c2c7;
    }
</style>

<div class="settings-container">
    <h2 class="settings-header">Pengaturan Akun</h2>
    <hr>

    {{-- Menampilkan pesan sukses atau error --}}
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Navigasi Tab Bootstrap --}}
    <ul class="nav nav-tabs mb-4" id="settingsTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="true">Ubah Kata Sandi</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="preferences-tab" data-bs-toggle="tab" data-bs-target="#preferences" type="button" role="tab" aria-controls="preferences" aria-selected="false">Preferensi</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="danger-zone-tab" data-bs-toggle="tab" data-bs-target="#danger-zone" type="button" role="tab" aria-controls="danger-zone" aria-selected="false">Zona Bahaya</button>
        </li>
    </ul>

    {{-- Konten Tab --}}
    <div class="tab-content" id="settingsTabContent">
        {{-- TAB: Ubah Kata Sandi --}}
        <div class="tab-pane fade show active" id="password" role="tabpanel" aria-labelledby="password-tab">
            <h3>{{ __('Ubah Kata Sandi') }}</h3>
<label for="language" class="form-label">{{ __('Pilih Bahasa:') }}</label>
            <p class="text-muted">Pastikan kata sandi Anda cukup panjang dan unik untuk keamanan.</p>
            <form method="POST" action="{{ route('settings.updatePassword') }}">
                @csrf
                {{-- @method('PUT') jika Anda menggunakan PUT/PATCH di rute --}}

                <div class="form-group">
                    <label for="current_password" class="form-label">Kata Sandi Lama:</label>
                    <input type="password" id="current_password" name="current_password"
                           class="form-control @error('current_password') is-invalid @enderror" required>
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Kata Sandi Baru:</label>
                    <input type="password" id="password" name="password"
                           class="form-control @error('password') is-invalid @enderror" required minlength="8">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="form-label">Konfirmasi Kata Sandi Baru:</label>
                    <input type="password" id="password-confirm" name="password_confirmation"
                           class="form-control" required>
                </div>

                <div class="d-flex justify-content-end mt-4"> {{-- align to end --}}
                    <button type="submit" class="btn-primary-action">Ubah Kata Sandi</button>
                </div>
            </form>
        </div>

        {{-- TAB: Preferensi (Ganti Bahasa & Tema) --}}
        <div class="tab-pane fade" id="preferences" role="tabpanel" aria-labelledby="preferences-tab">
            <h3>Preferensi Pengguna</h3>
            <p class="text-muted">Sesuaikan pengalaman aplikasi Anda.</p>

            {{-- Ganti Bahasa --}}
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Bahasa</h5>
                    <p class="card-text">Pilih bahasa yang Anda inginkan untuk antarmuka pengguna.</p>
                    <form method="POST" action="{{ route('settings.updateLanguage') }}">
                        @csrf
                        <div class="form-group">
                            <label for="language" class="form-label">Pilih Bahasa:</label>
                            <select id="language" name="language" class="form-control">
                                <option value="id" {{ session('locale', config('app.locale')) == 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                                <option value="en" {{ session('locale', config('app.locale')) == 'en' ? 'selected' : '' }}>English</option>
                                {{-- Tambahkan bahasa lain sesuai kebutuhan Anda --}}
                            </select>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn-primary-action">Simpan Bahasa</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Ganti Tema (Mode Terang/Gelap) --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Tema Antarmuka</h5>
                    <p class="card-text">Pilih antara mode terang atau gelap untuk tampilan aplikasi.</p>
                    <form method="POST" action="{{ route('settings.updateTheme') }}">
                        @csrf
                        <div class="form-group">
                            <label for="theme" class="form-label">Pilih Tema:</label>
                            <select id="theme" name="theme" class="form-control">
                                <option value="light" {{ session('theme', 'light') == 'light' ? 'selected' : '' }}>Terang</option>
                                <option value="dark" {{ session('theme', 'light') == 'dark' ? 'selected' : '' }}>Gelap</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn-primary-action">Simpan Tema</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- TAB: Zona Bahaya (Hapus Akun) --}}
        <div class="tab-pane fade" id="danger-zone" role="tabpanel" aria-labelledby="danger-zone-tab">
            <h3>Zona Bahaya</h3>
            <p class="text-muted">Tindakan ini tidak dapat dibatalkan. Mohon berhati-hati.</p>

            {{-- Hapus Akun --}}
            <div class="card border-danger shadow-sm">
                <div class="card-body text-danger">
                    <h5 class="card-title text-danger">Hapus Akun Anda</h5>
                    <p class="card-text">Setelah akun Anda dihapus, semua data dan informasi yang terkait dengan akun ini akan hilang secara permanen.</p>
                    <button type="button" class="btn-danger-action" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Hapus Akun</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus Akun --}}
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteAccountModalLabel">Konfirmasi Hapus Akun</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus akun Anda secara permanen? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="form-group">
                    <label for="confirm_password_delete" class="form-label">Masukkan Kata Sandi Anda untuk Konfirmasi:</label>
                    <input type="password" id="confirm_password_delete" name="password_confirmation_delete" class="form-control" required>
                </div>
                <div class="invalid-feedback d-none" id="deletePasswordError"></div> {{-- Untuk pesan error JS --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteAccountBtn">Hapus Akun Permanen</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Pastikan jQuery atau vanilla JS tersedia di layout utama Anda untuk fungsi tab Bootstrap
    // Pastikan Bootstrap JS (bundle) juga termuat di layout utama Anda
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen modal dan tombol
        const deleteAccountModal = document.getElementById('deleteAccountModal');
        const confirmDeleteAccountBtn = document.getElementById('confirmDeleteAccountBtn');
        const confirmPasswordInput = document.getElementById('confirm_password_delete');
        const deletePasswordError = document.getElementById('deletePasswordError');

        if (confirmDeleteAccountBtn) {
            confirmDeleteAccountBtn.addEventListener('click', function() {
                const password = confirmPasswordInput.value;
                deletePasswordError.classList.add('d-none'); // Sembunyikan error sebelumnya
                deletePasswordError.innerHTML = '';

                // Kirim permintaan DELETE ke backend
                fetch('{{ route('settings.deleteAccount') }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ password: password })
                })
                .then(response => {
                    return response.json().then(data => {
                        if (!response.ok) {
                            // Jika ada error (misal password salah)
                            if (data.errors && data.errors.password) {
                                deletePasswordError.classList.remove('d-none');
                                deletePasswordError.innerHTML = data.errors.password[0];
                            } else if (data.message) {
                                deletePasswordError.classList.remove('d-none');
                                deletePasswordError.innerHTML = data.message;
                            }
                            throw new Error(data.message || 'Gagal menghapus akun.');
                        }
                        return data;
                    });
                })
                .then(data => {
                    // Jika sukses, redirect atau lakukan sesuatu
                    if (data.success) {
                        window.location.href = data.redirect || '/'; // Redirect ke homepage atau login
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Error lain yang tidak ditangani oleh backend validation
                    if (!deletePasswordError.innerHTML) {
                        deletePasswordError.classList.remove('d-none');
                        deletePasswordError.innerHTML = 'Terjadi kesalahan. Coba lagi.';
                    }
                });
            });
        }
    });

    // Skrip untuk menyimpan tema ke Local Storage (Opsional, untuk persistent theme)
    // Ini adalah frontend-only. Untuk persistensi di backend, perlu database/cookie.
    document.addEventListener('DOMContentLoaded', function() {
        const themeSelect = document.getElementById('theme');
        if (themeSelect) {
            themeSelect.addEventListener('change', function() {
                const selectedTheme = this.value;
                document.body.setAttribute('data-theme', selectedTheme); // Atau ubah kelas CSS body
                localStorage.setItem('user-theme', selectedTheme);
            });

            // Apply theme on load
            const savedTheme = localStorage.getItem('user-theme');
            if (savedTheme) {
                document.body.setAttribute('data-theme', savedTheme);
                themeSelect.value = savedTheme;
            } else {
                // Default theme if not saved (e.g., light)
                document.body.setAttribute('data-theme', 'light');
                themeSelect.value = 'light';
            }
        }
    });

    // Example for setting language dynamically on frontend
    // For full language support, you'll need Laravel's localization system
    document.addEventListener('DOMContentLoaded', function() {
        const languageSelect = document.getElementById('language');
        if (languageSelect) {
            // No direct frontend effect here as language is handled by backend.
            // But you can add JS here if you want to change static texts without reload.
        }
    });
</script>
@endpush