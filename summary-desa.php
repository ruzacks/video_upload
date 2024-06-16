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

<div class="row">
<?php foreach ($desas as $desa) { ?>
    <div class="col-md-5">
        <h4 class="mb-1"><?= $desa->nama_desa ?></h4>
    </div>
    <div class="col-md-1 text-end">
        <h4 class="mb-1"><span class="counter"> <?= $desa->count_videos ?></span></h4>
    </div>
<?php } ?>
</div>