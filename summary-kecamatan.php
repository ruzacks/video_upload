<?php 
$conn = getConn();

$sql = "SELECT kecamatan.nama_kecamatan, kecamatan.id_kecamatan, COUNT(videos.nik) AS count_videos
        FROM kecamatan
        LEFT JOIN videos ON kecamatan.id_kecamatan = videos.id_kecamatan
        GROUP BY kecamatan.id_kecamatan, kecamatan.nama_kecamatan";

$result = mysqli_query($conn, $sql);

$kecamatans = []; // Initialize an empty array to store kecamatan data

// Fetch the result set as objects and store them in $kecamatans array
while ($row = mysqli_fetch_object($result)) {
    $kecamatans[] = $row;
}

mysqli_free_result($result); // Free the result set

mysqli_close($conn); // Close the database connection
?>

<div class="col-md-6 col-lg-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Data Setiap Kecamatan</h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
            </div>
        </div>
        <div class="iq-card-body">
            <?php foreach ($kecamatans as $kecamatan) { ?>
                <div class="row mt-4">
                    <div class="col-sm-8">
                        <div class="media-sellers">
                            <div class="media-sellers-media-info">
                                <h5 class="mb-0"><a class="text-dark" href="#"><?= $kecamatan->nama_kecamatan ?></a></h5>
                                <div class="sellers-dt">
                                    <span class="font-size-12">Jumlah Data: <?= $kecamatan->count_videos ?></span>
                                    <!-- Assuming 'Vendor' link is supposed to go to 'Detail Kecamatan' -->
                                    <span class="font-size-12"><a href="index.php?id_kec=<?= $kecamatan->id_kecamatan ?>">Lihat Detail</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center mt-3">
                        <h5 class="mb-0"><?= $kecamatan->count_videos ?></h5>
                        <span>Data</span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
