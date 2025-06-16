<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News Portal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(145deg, #f3f4f6 0%, #e5e7eb 100%);
    background-attachment: fixed;
    min-height: 100vh;
    margin: 0;
    overflow-x: hidden;
  }

  .navbar {
    background: linear-gradient(90deg, #4f46e5, #6366f1);
    padding: 1rem 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  }

  .navbar-brand {
    color: #fff;
    font-weight: 700;
    font-size: 1.5rem;
    transition: color 0.3s;
  }

  .navbar-brand:hover {
    color: #d1d5db;
  }

  .nav-link {
    color: #e0e7ff !important;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .nav-link:hover {
    color: #c7d2fe !important;
    transform: scale(1.05);
  }

  .fade-in {
    animation: fadeIn 0.5s ease-in-out both;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .content-wrapper {
    max-width: 90%;
    margin: 0 auto;
    padding-left: 1rem;
    padding-right: 1rem;
    position: relative;
    z-index: 10;
  }

  .side-stripe-left,
  .side-stripe-right {
    position: fixed;
    top: 0;
    width: 12px;
    height: 100vh;
    background: linear-gradient(to bottom, #6366f1, transparent);
    z-index: 1;
    opacity: 0.25;
  }

  .side-stripe-left {
    left: 0;
    border-top-right-radius: 1rem;
  }

  .side-stripe-right {
    right: 0;
    border-top-left-radius: 1rem;
  }

  footer {
    background-color: #1f2937;
    color: #f3f4f6;
    text-align: center;
    padding: 1rem 0;
    margin-top: 4rem;
  }

  footer a {
    color: #93c5fd;
    text-decoration: none;
    transition: color 0.3s;
  }

  footer a:hover {
    color: #bfdbfe;
    text-decoration: underline;
  }

  .breaking-news-bar {
  background: linear-gradient(90deg, #4f46e5, #6366f1);
  color: #fff;
  padding: 0.5rem 1rem;
  font-weight: 600;
  font-size: 1rem;
  text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
  position: relative;
  z-index: 15;
  border-bottom: 2px solid #4338ca;
}

/* Glow animation for the side stripes */
@keyframes glowPulse {
  0% { opacity: 0.15; transform: scaleY(1); }
  50% { opacity: 0.4; transform: scaleY(1.02); }
  100% { opacity: 0.15; transform: scaleY(1); }
}

.side-stripe-left,
.side-stripe-right {
  animation: glowPulse 2.5s infinite ease-in-out;
}

/* === TOMBOL HOVER KEREN === */
.btn {
  transition: all 0.3s ease;
  border-radius: 0.5rem;
  font-weight: 600;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
}

.btn:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
}

/* === KARTU BERITA (CARD) HOVER EFFECT === */
.card {
  transition: all 0.3s ease-in-out;
  border-radius: 1rem;
  overflow: hidden;
}

.card:hover {
  transform: translateY(-5px) scale(1.01);
  box-shadow: 0 12px 24px rgba(99, 102, 241, 0.15);
  border: 1px solid #e0e7ff;
}


</style>

  </head>

  <body>
    
  <!-- Garis dekoratif di kiri-kanan -->
  <div class="side-stripe side-stripe-left"></div>
  <div class="side-stripe side-stripe-right"></div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">📰 News Portal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/login">👤 Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="breaking-news-bar">
  <marquee behavior="scroll" direction="left" scrollamount="6">
    📰 Breaking News: Portal berita ini sedang dalam pengembangan! Stay tuned untuk update terbaru ✨ | 🎉 Welcome to the News Portal | 🚀 Powered by Laravel & Gen Z vibes 😎
  </marquee>
</div>


  <!-- Konten -->
  <div class="content-wrapper fade-in py-5">
    @yield('content')

  </div>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p class="mb-0">© {{ date('Y') }} News Portal. Made with 💙 by Fawwaz.</p>
      <small><a href="https://github.com/">GitHub</a> | <a href="#">Contact</a></small>
    </div>
  </footer>



  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
