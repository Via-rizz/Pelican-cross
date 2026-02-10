<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'functions.php';

$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM  hitung"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset ($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$counts = query("SELECT * FROM hitung LIMIT $awalData, $jumlahDataPerHalaman");

?>
<!DOCTYPE html>
<html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <link rel="stylesheet" href="styledata.css">
        </head>
 	<body>
        <nav>
		<ul>
			<li class="logo"><img alt="" src="data:image/png;base64,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"></li>
			<li>
				<a href="utama.php"><i class="fa fa-home"></i>   Beranda</a>
			</li>
			<li>
				<a href="data.php"><i class="fa fa-book"></i>   Data</a>
			</li>
			<li>
				<a href="grafik.php"><i class="fa fa-users"></i>   grafik</a>
			</li>
			<li>
				<a href="contact.php"><i class="fa fa-picture-o"></i>   contact</a>
			</li>
			<li>
				<a href="logout.php"><i class="fa fa-phone"></i>   logout</a>
			</li>
		</ul>
	</nav>
	<div class="wrapper">
		<div class="section">
			<div class="box-area">
				<div class = "head">
				<img src = "dishub.png" width = "127" height = "150" align = "right" alt="gambar" >	
					<div class="judul"><h1> Dinas Perhubungan</h1>
                    <h1>Kota Madiun</h1></div>
                </div>
                <section class="contact">
				<div class="container">
					<div class = "tabel">
						<h4>Tabel Data Penyebrang</h4>
					</div>
						<table id= "table" class="table">
						<thead class="thead-dark">
							<tr>
							<th scope="col">No</th>
							<th scope="col">Tanggal</th>
							<th scope="col">Jumlah</th>
							<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php $i= 1; ?>	
						<?php foreach($counts as $row) : ?>
							<tr>
							<th><?= $i ?></th>
							<td><?= $row["tanggal"] ?></td>
							<td><?= $row["jumlah"] ?></td>
							<td>
								<a href="hapus.php?id=<?= $row["id"]; ?>">hapus</a></td>
							</tr>
						<?php $i++; ?>	
						<?php endforeach; ?>	
						</tbody>
						</table>
                    </div>
					
					<div class = "pagination">
					<?php if ($halamanAktif > 1) : ?>
						<a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
					<?php endif; ?>

					<?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
						<?php if ($i == $halamanAktif) :?>
							<a class= "active" href= "?halaman=<?= $i; ?>"><?= $i; ?></a>
						<?php else : ?>
							<a href= "?halaman=<?= $i; ?>"><?= $i; ?></a>
						<?php endif; ?>
					<?php endfor; ?>

					<?php if ($halamanAktif < $jumlahHalaman) : ?>
						<a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
					<?php endif; ?>
					</div>
                </section>
			</div>
	    </div>
    </div>
</body>
</html>