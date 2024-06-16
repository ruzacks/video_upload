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

<div class="row">
<?php foreach ($kecamatans as $kecamatan) { ?>
    <div class="col-md-5">
        <h4 class="mb-1"><?= $kecamatan->nama_kecamatan ?></h4>
    </div>
    <div class="col-md-1">
        <h4 class="mb-1"><span class="counter"> <?= $kecamatan->count_videos ?></span></h4>
    </div>
<?php } ?>
</div>
    
