<?php 
$conn = getConn();

$idKecamatan = $_GET['id_kec'];
$sql = "SELECT nama_kecamatan FROM kecamatan WHERE id_kecamatan = '$idKecamatan'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $namaKecamatan = $row['nama_kecamatan'];
} 

$sql = "SELECT desa.nama_desa, desa.id_desa, COUNT(videos.nik) AS count_videos
        FROM desa
        LEFT JOIN videos ON desa.id_desa = videos.id_desa
        WHERE desa.id_kecamatan = '$idKecamatan'
        GROUP BY desa.id_desa, desa.nama_desa";

$result = mysqli_query($conn, $sql);

$desas = []; // Initialize an empty array to store kecamatan data

// Fetch the result set as objects and store them in $desas array
while ($row = mysqli_fetch_object($result)) {
    $desas[] = $row;
}

mysqli_free_result($result); // Free the result set

mysqli_close($conn); // Close the database connection
?>

<div class="col-md-6 col-lg-12">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Data Kecamatan <?= $namaKecamatan ?></h4>
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
            </div>
        </div>
        <div class="iq-card-body">
            <?php foreach ($desas as $desa) { ?>
                <div class="row mt-4">
                    <div class="col-sm-8">
                        <div class="media-sellers">
                            <div class="media-sellers-media-info">
                                <h5 class="mb-0"><a class="text-dark" href="#"><?= $desa->nama_desa ?></a></h5>
                                <div class="sellers-dt">
                                    <span class="font-size-12">Jumlah Data: <?= $desa->count_videos ?></span>
                                    <!-- Assuming 'Vendor' link is supposed to go to 'Detail desa' -->
                                    <span class="font-size-12"><a href="index.php?id_des=<?= $desa->id_desa ?>">Lihat Detail</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center mt-3">
                        <h5 class="mb-0"><?= $desa->count_videos ?></h5>
                        <span>Data</span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
