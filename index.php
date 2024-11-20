<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pertanian";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

$sql = "SELECT id,nama, bahan, alat FROM alat";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIIRBEEL - Toko Pertanian Indonesia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">WIIRBEEL</div>
            <ul class="nav-menu">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#produk">Produk</a></li>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Main Content -->
    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Selamat Datang di WIIRBEEL</h1>
                <p>Temukan segala kebutuhan pertanian Anda di sini.</p>
                <button class="btn-primary">Pesan Sekarang</button>
            </div>
        </div>
    </section>

    <!-- Produk Section -->
    <section id="produk" class="products">
        <div class="container">
            <h2 class="section-title">Produk Unggulan</h2>
            <div class="product-grid">
                <div class="product-card">
                    <img src="https://png.pngtree.com/thumb_back/fw800/background/20230424/pngtree-green-plant-seeds-in-trays-under-a-grow-light-image_2508589.jpg" alt="Bibit Tanaman">
                    <h3>Bibit Tanaman</h3>
                    <span class="price">Rp 50.000</span>
                    <button class="btn-secondary">Pesan</button>
                </div>
                <div class="product-card">
                    <img src="https://www.beritajogja.id/wp-content/uploads/2020/06/Pupuk-Kandang.jpg" alt="Pupuk">
                    <h3>Pupuk</h3>
                    <span class="price">Rp 150.000</span>
                    <button class="btn-secondary">Pesan</button>
                </div>
                <div class="product-card">
                    <img src="https://tokodeeres.com/wp-content/uploads/2021/02/alat-alat-pertanian-e1614238298179.jpg" alt="Alat Pertanian">
                    <h3>Alat Pertanian</h3>
                    <span class="price">Rp 350.000</span>
                    <button class="btn-secondary">Pesan</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="about">
        <div class="container">
            <h2>Tentang WIIRBEEL</h2>
            <p>"WIIRBEEL: Toko Pertanian Terpercaya! 🌱 Temukan produk pertanian berkualitas, mulai dari bibit tanaman, pupuk, hingga alat pertanian untuk mendukung usaha Anda. Kami hadir untuk membantu petani dan penggiat pertanian dengan pelayanan terbaik dan produk terbaik."</p>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="contact">
        <div class="container">
            <h2>Hubungi Kami</h2>
            <form class="contact-form">
                <input type="text" placeholder="Nama Lengkap" required>
                <input type="email" placeholder="Email" required>
                <textarea placeholder="Pesan Anda" required></textarea>
                <button type="submit" class="btn-primary">Kirim Pesan</button>
            </form>
        </div>
    </section>

    <section class="data">
        <div class="container">

            <h2>Daftar Pekerja Kami</h2>
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Bahan</th>
                            <th>Alat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['bahan']; ?></td>
                                <td><?php echo $row['alat']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Tidak ada data untuk ditampilkan.</p>
            <?php endif; ?>
        </div>
    </section>
    <!-- End Main Content -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 WIIRBEEL. Semua hak dilindungi.</p>
        </div>
    </footer>
    <!-- End Footer -->

    <script src="script.js"></script>
</body>
</html>