{{-- resources/views/profile/show.blade.php --}}

@extends('layouts.app') {{-- Pastikan ini mengarah ke layout utama Anda --}}

@section('title', 'Profil Saya')

@section('content')
<style>
    /* Styling khusus untuk halaman profil (sama seperti sebelumnya) */
    .profile-container {
        max-width: 800px;
        margin: 3rem auto;
        padding: 2.5rem;
        background-color: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #e0e7ff; /* Light border from your theme */
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

    .profile-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .profile-picture-wrapper {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 1.5rem;
        border: 5px solid #6366f1; /* Border using your theme color */
        box-shadow: 0 0 0 7px rgba(99, 102, 241, 0.2); /* Soft glow effect */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .profile-picture-wrapper:hover {
        transform: scale(1.05);
        box-shadow: 0 0 0 9px rgba(99, 102, 241, 0.3);
    }

    .profile-picture {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-name {
        font-size: 2.2rem;
        font-weight: 700;
        color: #1a202c; /* Darker text for name */
        margin-bottom: 0.5rem;
    }

    .profile-email {
        font-size: 1.1rem;
        color: #6b7280; /* Muted gray for email */
        margin-bottom: 2rem;
    }

    .profile-details-grid {
        display: grid;
        grid-template-columns: 1fr; /* Single column on small screens */
        gap: 1.5rem;
        text-align: left;
    }

    @media (min-width: 768px) { /* Two columns on medium screens and up */
        .profile-details-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    .detail-item {
        background-color: #f9fafb; /* Lighter background for detail items */
        padding: 1.2rem 1.5rem;
        border-radius: 0.75rem;
        border: 1px solid #e5e7eb;
        transition: background-color 0.3s ease;
    }

    .detail-item:hover {
        background-color: #f3f4f6;
    }

    .detail-label {
        font-weight: 600;
        color: #4b5563;
        font-size: 0.95rem;
        margin-bottom: 0.4rem;
        display: block;
    }

    .detail-value {
        font-size: 1.05rem;
        color: #1f2937;
        word-wrap: break-word; /* Ensure long text wraps */
    }

    .profile-actions {
        text-align: center;
        margin-top: 3rem;
        display: flex; /* Mengatur tata letak tombol secara flex */
        flex-wrap: wrap; /* Memungkinkan tombol pecah baris di layar kecil */
        justify-content: center; /* Tombol berada di tengah */
        gap: 1rem; /* Jarak antar tombol */
    }

    .btn-profile-action {
        background-color: #4f46e5; /* Primary button color */
        color: #ffffff;
        padding: 0.8rem 1.8rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        flex-shrink: 0; /* Mencegah tombol menyusut terlalu kecil */
    }

    .btn-profile-action:hover {
        background-color: #4338ca; /* Darker shade on hover */
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
    }

    /* Styling khusus untuk tombol sekunder, jika diperlukan */
    .btn-secondary-action {
        background-color: #6c757d; /* Gray for secondary action */
        color: #ffffff;
        padding: 0.8rem 1.8rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        flex-shrink: 0;
    }

    .btn-secondary-action:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
    }


    /* SVG icon styling for default profile picture */
    .profile-picture-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e5e7eb; /* Light gray background for placeholder */
        color: #6b7280; /* Muted gray for icon */
    }

    .profile-picture-placeholder svg {
        width: 60%; /* Adjust size of SVG inside placeholder */
        height: 60%;
    }

</style>

<div class="profile-container">
<div class="profile-header">
    <div class="profile-picture-wrapper">
        <a href="#" id="profilePictureLink"> {{-- Add an ID for easy selection with JS and make it clickable --}}
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Foto Profil {{ $user->name }}" class="profile-picture" data-full-image="{{ asset('storage/' . $user->profile_picture) }}"> {{-- Add data-full-image attribute --}}
            @else
                <div class="profile-picture-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 1.37A7 7 0 0 0 8 1"/>
                    </svg>
                </div>
            @endif
        </a>
    </div>
</div>

{{-- The Modal Structure --}}
<div id="imageModal" class="modal">
    <span class="close-button">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>

<style>
    /* Basic Modal Styles */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1000; /* Sit on top */
        padding-top: 50px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    .close-button {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close-button:hover,
    .close-button:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* Styling untuk wadah utama detail grid */
.profile-details-grid {
    /* Background untuk seluruh area grid */
    background-color: #f8f9fa; /* Warna abu-abu terang */
    border-radius: 10px; /* Sudut membulat untuk estetika */
    padding: 20px; /* Ruang di dalam kotak background */
    margin-top: 20px; /* Jarak dari elemen di atasnya (misal: nama/email) */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek bayangan lembut */

    /* Tata letak grid untuk detail-item */
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Responsif, setiap kolom min 200px */
    gap: 15px; /* Jarak antara setiap detail-item */
}

/* Styling untuk setiap item detail individu di dalam grid */
.detail-item {
    background-color: #ffffff; /* Background putih untuk setiap item */
    border: 1px solid #e0e0e0; /* Border tipis */
    border-radius: 8px; /* Sudut membulat */
    padding: 15px; /* Ruang di dalam setiap item */
    text-align: center; /* Teks di tengah */
    transition: transform 0.2s ease-in-out; /* Efek transisi saat hover */
}

.detail-item:hover {
    transform: translateY(-3px); /* Sedikit naik saat di-hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Bayangan sedikit lebih kuat */
}

.detail-label {
    display: block; /* Memastikan label di baris terpisah */
    font-size: 0.9em;
    color: #6c757d; /* Warna abu-abu gelap untuk label */
    margin-bottom: 5px;
    font-weight: 600; /* Sedikit lebih tebal */
    text-transform: uppercase; /* Huruf kapital */
}

.detail-value {
    font-size: 1.1em;
    color: #343a40; /* Warna teks utama */
    font-weight: bold; /* Teks nilai lebih tebal */
}
</style>

<script>
    // Get the modal
    var modal = document.getElementById("imageModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var profilePictureLink = document.getElementById("profilePictureLink");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    profilePictureLink.onclick = function(event){
        event.preventDefault(); // Prevent default link behavior
        var profileImage = this.querySelector('.profile-picture');
        if (profileImage) { // Check if an actual image exists
            modal.style.display = "block";
            modalImg.src = profileImage.getAttribute('data-full-image'); // Use the full image path
            captionText.innerHTML = profileImage.alt;
        } else { // If it's a placeholder, you might not want to open a modal or show a generic message
            // Optionally, you can display a message or do nothing
            console.log("No profile picture to display.");
        }
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close-button")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal content, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
        <h2 class="profile-name">{{ $user->name }}</h2>
        <p class="profile-email">{{ $user->email }}</p>
    </div>

    <div class="profile-details-grid">
        @if($user->created_at)
        <div class="detail-item">
            <span class="detail-label">Bergabung Sejak</span>
            <span class="detail-value">{{ $user->created_at->format('d F Y') }}</span>
        </div>
        @endif

        {{-- Contoh detail opsional: Role (jika ada sistem role) --}}
        @if($user->role)
        <div class="detail-item">
            <span class="detail-label">Role</span>
            <span class="detail-value">{{ ucfirst($user->role) }}</span>
        </div>
        @endif
    </div>

    <div class="profile-actions">
        {{-- Tautan untuk mengedit profil --}}
        <a href="{{ route('profile.edit') ?? '#' }}" class="btn-profile-action">Edit Profil</a>

        {{-- Tautan untuk pengaturan akun (jika ada) --}}
        <a href="{{ route('settings.index') ?? '#' }}" class="btn-profile-action">Pengaturan Akun</a>

        <div style="flex-basis: 100%; height: 1rem;"></div> {{-- Spacer untuk memisahkan baris tombol --}}

        {{-- Tombol baru: Kembali ke Dashboard --}}
        <a href="{{ route('dashboard') ?? '/' }}" class="btn-secondary-action">Kembali ke Dashboard</a>

        {{-- Tombol baru: Kelola Berita --}}
        <a href="{{ route('berita.index') ?? '#' }}" class="btn-secondary-action">Kelola Berita</a>
    </div>
</div>
@endsection