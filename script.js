// Mendapatkan semua tombol dengan kelas 'btn-secondary' (tombol Pesan)
const pesanButtons = document.querySelectorAll('.btn-secondary');

// Menambahkan event listener untuk setiap tombol
pesanButtons.forEach(button => {
    button.addEventListener('click', function() {
        // Menampilkan alert ketika tombol diklik
        alert('Produk belum tersedia');
    });
});
