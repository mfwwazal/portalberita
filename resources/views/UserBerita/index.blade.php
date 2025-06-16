@extends('layouts.appuser')
@section('title', 'Berita')

@section('content')

<style>
    .container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
        background: #ffffff;
        font-family: 'Inter', sans-serif;
        color: #374151;
    }
    .row {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
    }
    .card {
        background: #ffffff;
        border-radius: 0.75rem;
        box-shadow: 0 1px 4px rgb(0 0 0 / 0.1);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
        cursor: default;
        user-select: text;
    }
    .card:hover {
        box-shadow: 0 4px 10px rgb(0 0 0 / 0.15);
    }
    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: contain;
        background-color: #f9fafb;
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
    }
    .card-body {
        padding: 1rem 1.25rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card-text {
        color: #6b7280;
        font-size: 1rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        white-space: pre-line;
    }
    .btn-group {
        display: flex;
        gap: 0.5rem;
    }
    .btn {
        font-size: 0.875rem;
        padding: 0.3rem 0.7rem;
        border-radius: 0.375rem;
        border: 1px solid #4b5563;
        background: transparent;
        color: #4b5563;
        cursor: pointer;
        transition: background-color 0.25s ease, color 0.25s ease;
    }
    .btn:hover,
    .btn:focus {
        background-color: #374151;
        color: white;
        outline: none;
    }
    .text-body-secondary {
        color: #9ca3af;
        font-size: 0.875rem;
        align-self: center;
    }
    .read-more-btn {
        background: none;
        border: none;
        color: #2563eb;
        font-weight: 600;
        cursor: pointer;
        padding: 0;
        font-size: 0.9rem;
        user-select: none;
        transition: color 0.3s ease;
    }
    .read-more-btn:hover,
    .read-more-btn:focus {
        color: #1e40af;
        outline: none;
    }
    /* Modal Styles */
    .modal-overlay {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: rgba(0,0,0,0.28) !important;
        z-index: 99999 !important;
        display: none;
        align-items: center !important;
        justify-content: center !important;
        overflow: auto !important;
    }
    .modal-overlay.active {
        display: flex !important;
    }
    .modal-content {
        background: #fff;
        border-radius: 0.75rem;
        max-width: 600px;
        width: 90vw;
        max-height: 80vh;
        overflow-y: auto !important;
        padding: 2rem 1.5rem 1.5rem 1.5rem;
        position: relative;
        box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        font-family: 'Inter', sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .modal-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #111827;
        width: 100%;
        text-align: center;
    }
    .modal-close {
        position: absolute;
        right: 1.2rem;
        top: 1rem;
        background: none;
        border: none;
        font-size: 1.6rem;
        color: #6b7280;
        cursor: pointer;
        z-index: 2;
    }
    .modal-content::-webkit-scrollbar {
        width: 8px;
        background: transparent;
    }
    .modal-content::-webkit-scrollbar-thumb {
        background: #e5e7eb;
        border-radius: 4px;
    }
</style>

<div class="container">
    <div class="row" role="list">
        @forelse ($beritas as $berita)
            <article class="card" role="listitem" aria-label="Berita: {{ $berita->judul }}">
                <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}">

                <div class="card-body">
                    <h2 style="font-weight: 700; font-size: 1.25rem; margin-bottom: 0.75rem; color: #111827;">{{ $berita->judul }}</h2>
                    <p class="card-text"
                       data-fulltext="{{ e($berita->konten) }}"
                       data-title="{{ e($berita->judul) }}">
                    </p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <small class="text-body-secondary">{{ $berita->created_at->format('d M Y') }}</small>
                    </div>
                </div>
            </article>
        @empty
            <p>Tidak ada berita yang tersedia.</p>
        @endforelse
    </div>
</div>

<!-- MODAL POPUP -->
<div class="modal-overlay" id="modalBerita" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-content">
        <button class="modal-close" aria-label="Tutup">&times;</button>
        <div class="modal-title" id="modalBeritaTitle"></div>
        <div id="modalBeritaContent" style="white-space: pre-line; color: #374151; width: 100%;"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const maxLength = 120;
        const cards = document.querySelectorAll('.card-text');

        // Modal references
        const modal = document.getElementById('modalBerita');
        const modalTitle = document.getElementById('modalBeritaTitle');
        const modalContent = document.getElementById('modalBeritaContent');
        const modalClose = document.querySelector('.modal-close');

        cards.forEach(p => {
            const fullText = p.getAttribute('data-fulltext')?.trim() || '';
            const title = p.getAttribute('data-title') || '';
            if (fullText.length <= maxLength) {
                p.textContent = fullText;
                return;
            }
            const truncated = fullText.slice(0, maxLength).trimEnd() + '... ';
            p.textContent = truncated;

            const btn = document.createElement('button');
            btn.textContent = 'Selengkapnya';
            btn.setAttribute('type', 'button');
            btn.classList.add('read-more-btn');
            btn.setAttribute('aria-expanded', 'false');
            p.appendChild(btn);

            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                modalTitle.textContent = title;
                modalContent.textContent = fullText;
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        function hideModal() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        modalClose.addEventListener('click', hideModal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) hideModal();
        });
        document.addEventListener('keydown', function(e) {
            if (modal.classList.contains('active') && e.key === 'Escape') hideModal();
        });
    });
</script>

@endsection