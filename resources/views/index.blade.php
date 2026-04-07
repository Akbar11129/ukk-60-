<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APSA School - Aplikasi Pengaduan Sarana Sekolah</title>
    <style>
        :root {
            --primary: #2989d8;
            --primary-dark: #1e5799;
            --secondary: #ff6b35;
            --light: #f8f9fa;
            --dark: #2c3e50;
            --gradient: linear-gradient(135deg, #1e5799 0%, #2989d8 100%);
            --gradient-secondary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .navbar {
            background: var(--gradient);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-section {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 10px 0;
    text-decoration: none;
    color: inherit;
}

/* Styling untuk gambar logo */
.logo-img {
    width: 60px;           /* Ukuran default untuk desktop */
    height: 60px;          /* Proporsi 1:1 */
    object-fit: contain;   /* Gambar tidak terdistorsi */
    transition: all 0.3s ease;
    border-radius: 8px;    /* Sudut sedikit melengkung */
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1); /* Bayangan halus */
}

/* Efek hover pada logo */
.logo-img:hover {
    transform: scale(1.05); /* Sedikit membesar saat hover */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
}


        .logo-text {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        .hero {
            background: var(--gradient-secondary);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: var(--secondary);
            color: white;
        }

        .btn-primary:hover {
            background: #ff5722;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
        }

        .btn-secondary {
            background: white;
            color: var(--primary);
        }

        .btn-secondary:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        .features {
            padding: 4rem 2rem;
            background: var(--light);
        }

        .features-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: var(--dark);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .user-types {
            padding: 4rem 2rem;
            background: white;
        }

        .user-types-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .user-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .user-card {
            background: var(--gradient-secondary);
            color: white;
            padding: 2.5rem;
            border-radius: 20px;
        }

        .user-card h3 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-card ul {
            list-style: none;
        }

        .user-card li {
            padding: 0.5rem 0;
            padding-left: 1.5rem;
            position: relative;
        }

        .user-card li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--secondary);
            font-weight: bold;
        }

        .cta-section {
            background: var(--gradient);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        footer {
            background: var(--dark);
            color: white;
            text-align: center;
            padding: 2rem;
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2rem; }
            .hero p { font-size: 1.1rem; }
            .section-title { font-size: 2rem; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <div class="logo-section">
    <!-- Logo utama -->
    <img src="{{ asset('storage/img/Logo.png') }}"
         alt="Logo APSA School"
         class="logo-img">

    <!-- Hapus placeholder karena sudah ada gambar -->
    <!-- <div class="logo-placeholder">APSA</div> -->

    <div class="logo-text">APSA School</div>
</div>
            <ul class="nav-links">
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#fitur">Fitur</a></li>
                <li><a href="#pengguna">Pengguna</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>
        </div>
    </nav>

    <section class="hero" id="beranda">
        <div class="hero-content">
            <h1> Aplikasi Pengaduan Sarana Sekolah</h1>
            <p>Sampaikan aspirasi Anda untuk lingkungan sekolah yang lebih baik!</p>
            <div class="cta-buttons">
                <a href="login" class="btn btn-primary">Login</a>
            </div>
        </div>
    </section>

    <section class="features" id="fitur">
        <div class="features-content">
            <h2 class="section-title"> Fitur Unggulan</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <h3>Form Aspirasi</h3>
                    <p>Siswa dapat menyampaikan pengaduan dengan mudah melalui form yang tersedia.</p>
                </div>
                <div class="feature-card">
                    <h3>Dashboard Admin</h3>
                    <p>Kelola semua aspirasi dengan fitur filter untuk monitoring efektif.</p>
                </div>
                <div class="feature-card">
                    <h3>Umpan Balik</h3>
                    <p>Berikan respon langsung dan update status penyelesaian.</p>
                </div>
                <div class="feature-card">
                    <h3>Tracking Progress</h3>
                    <p>Pantau progres perbaikan dan histori aspirasi.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="user-types" id="pengguna">
        <div class="user-types-content">
            <h2 class="section-title"> Untuk Setiap Pengguna</h2>
            <div class="user-grid">
                <div class="user-card">
                    <h3>Admin</h3>
                    <ul>
                        <li>Lihat list aspirasi keseluruhan</li>
                        <li>Filter per tanggal, bulan, siswa</li>
                        <li>Update status penyelesaian</li>
                        <li>Berikan umpan balik</li>
                    </ul>
                </div>
                <div class="user-card">
                    <h3> Siswa</h3>
                    <ul>
                        <li>Sampaikan aspirasi dengan mudah</li>
                        <li>Lihat status penyelesaian</li>
                        <li>Baca umpan balik dari admin</li>
                        <li>Pantau progres perbaikan</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section" id="kontak">
        <h2>Siap Meningkatkan Kualitas Sekolah?</h2>
        <p>Bergabunglah dengan sistem pengaduan digital yang modern</p>
        <a href="#" class="btn btn-primary">Mulai Sekarang</a>
    </section>

    <footer>
        <p>© 2025 APSA School - Aplikasi Pengaduan Sarana Sekolah</p>
        <p>Dikembangkan untuk UKK Rekayasa Perangkat Lunak 2025/2026</p>
    </footer>


</body>
</html>
