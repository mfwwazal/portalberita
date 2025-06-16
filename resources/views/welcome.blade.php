<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Admin</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
    /* Reset */
    *, *::before, *::after {
      box-sizing: border-box;
    }
    body {
      font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
        Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
      background-color: #ffffff;
      margin: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: #6b7280; /* neutral gray body text */
      line-height: 1.6;
      font-size: 17px;
    }
    .container {
      max-width: 1200px;
      width: 100%;
      margin-left: auto;
      margin-right: auto;
      padding: 2rem 1.5rem;
      flex: 1 0 auto;
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }
    header {
      background: transparent;
      padding: 1.5rem 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #e5e7eb;
    }
    .logo {
      font-weight: 700;
      font-size: 1.75rem;
      color: #111827;
      user-select: none;
    }
    nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      gap: 1.5rem;
      align-items: center;
    }
    nav a, .logout-btn {
      font-weight: 600;
      font-size: 1rem;
      color: #374151;
      text-decoration: none;
      background: none;
      border: none;
      cursor: pointer;
      font-family: inherit;
      padding: 0.25rem 0.5rem;
      border-radius: 8px;
      user-select: none;
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    nav a:hover,
    nav a:focus-visible,
    .logout-btn:hover,
    .logout-btn:focus-visible {
      background-color: #fbbf24; /* yellow-400 */
      color: #111827; /* dark text */
      outline: none;
    }
    .logout-btn:focus-visible {
      outline: 2px solid #fbbf24;
      outline-offset: 2px;
    }
    .dashboard h2 {
      font-size: 3rem;
      font-weight: 700;
      margin: 0 0 1rem 0;
      color: #111827;
      user-select: none;
    }
    .admin-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
    }
    .card {
      background-color: #f9fafb;
      padding: 2rem;
      border-radius: 0.75rem;
      box-shadow: 0 8px 20px rgb(0 0 0 / 0.05);
      display: flex;
      flex-direction: column;
      justify-content: center;
      user-select: none;
      color: #374151;
    }
    .card h3 {
      margin: 0 0 0.5rem 0;
      font-weight: 600;
      font-size: 1.25rem;
      color: #111827;
    }
    .card p {
      font-size: 1.25rem;
      margin: 0;
      line-height: 1.2;
    }
    /* Footer as full-width bar with vertically and horizontally centered text */
    footer {
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f9fafb;
      color: #6b7280;
      padding: 1rem 1.5rem;
      font-size: 1rem;
      user-select: none;
      flex-shrink: 0;
      border-top: 1px solid #e5e7eb;
    }
  </style>
</head>
<body>
  <header class="container">
    <div class="logo">ADMIN<span>PANEL</span></div>
    <nav>
      <ul>
        <li><a href="/dashboard">Dashboard</a></li>
        <li><a href="/berita">Kelola Berita</a></li>
        <li>
          <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="logout-btn" aria-label="Logout">Logout</button>
          </form>
        </li>
      </ul>
    </nav>
  </header>

  <main class="container dashboard" role="main">
    <h2>Selamat Datang, Admin!</h2>
    <div class="admin-cards" aria-label="Admin metrics">
      <section class="card" aria-labelledby="total-berita-title">
        <h3 id="total-berita-title">Total Berita</h3>
        <p>📄 {{ $totalBerita }} Berita</p>
      </section>
      <section class="card" aria-labelledby="pengguna-title">
        <h3 id="pengguna-title">Pengguna Terdaftar</h3>
        <p>👤 2 Admin</p>
      </section>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 PortalBerita.co.id | Admin Panel by Fawwaz</p>
  </footer>
</body>
</html>

