<?php
    $userConn = getConn();

    $sql = "SELECT id_kecamatan, nama_kecamatan FROM kecamatan";
    $result = mysqli_query($userConn, $sql);

    $kecamatans = [];
    while ($row = mysqli_fetch_object($result)) {
        $kecamatans[] = $row;
    }

    $sql = "SELECT id_desa, nama_desa FROM desa";
    $result = mysqli_query($userConn, $sql);

    $desas = [];
    while ($row = mysqli_fetch_object($result)) {
        $desas[] = $row;
    }
?>