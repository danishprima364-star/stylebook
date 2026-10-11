<?php
require __DIR__ . '/includes/bootstrap.php';
$layanan = []; $sty = [];
try {
    $layanan = rows("SELECT nama_layanan, harga, durasi_menit FROM layanan WHERE aktif = 1 ORDER BY harga LIMIT 6");
    $sty = rows("SELECT s.nama, s.spesialisasi, v.rata_rating, v.jumlah_ulasan FROM stylist s JOIN v_rating_stylist v ON v.id_stylist = s.id_stylist WHERE s.aktif = 1");
} catch (Throwable $ex) { /* database belum diinstal */ }
public_header('Beranda');
?>
<div class="hero p-4 p-md-5 mb-4">
  <h1 class="fw-bold">Potong rapi, tanpa antre lama ✂️</h1>
  <p class="lead opacity-75 mb-4">Booking stylist favoritmu secara online, pilih jam yang kosong, dan kumpulkan poin member di setiap kunjungan.</p>
  <div class="d-flex flex-wrap gap-2">
    <a class="btn btn-warning btn-lg" href="book.php"><i class="bi bi-calendar-plus"></i> Booking Sekarang</a>
    <a class="btn btn-outline-light btn-lg" href="gaya.php"><i class="bi bi-stars"></i> Rekomendasi Gaya AI</a>
    <a class="btn btn-outline-light btn-lg" href="display.php" target="_blank"><i class="bi bi-tv"></i> Layar Antrian</a>
  </div>
</div>
<?php if (!$layanan): ?>
  <div class="alert alert-warning">Database belum siap. Jalankan <a href="setup.php">setup.php</a> terlebih dahulu.</div>
<?php else: ?>
<div class="row g-3">
  <div class="col-md-6"><div class="card h-100"><div class="card-header">Layanan Populer</div><ul class="list-group list-group-flush">
    <?php foreach ($layanan as $l): ?><li class="list-group-item d-flex justify-content-between"><span><?= e($l['nama_layanan']) ?> <small class="text-muted">· <?= (int)$l['durasi_menit'] ?> mnt</small></span><b><?= rupiah($l['harga']) ?></b></li><?php endforeach; ?>
  </ul></div></div>
  <div class="col-md-6"><div class="card h-100"><div class="card-header">Stylist Kami</div><ul class="list-group list-group-flush">
    <?php foreach ($sty as $s): ?><li class="list-group-item d-flex justify-content-between"><span><b><?= e($s['nama']) ?></b><br><small class="text-muted"><?= e($s['spesialisasi']) ?></small></span>
      <span class="text-end">⭐ <?= $s['rata_rating'] ? e($s['rata_rating']) : '-' ?><br><small class="text-muted"><?= (int)$s['jumlah_ulasan'] ?> ulasan</small></span></li><?php endforeach; ?>
  </ul></div></div>
</div>
<div class="text-center mt-4"><a class="btn btn-outline-dark" href="login.php"><i class="bi bi-box-arrow-in-right"></i> Login Staf / Penguji</a></div>
<?php endif; ?>
<?php page_footer(); ?>
