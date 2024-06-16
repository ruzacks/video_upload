<?php
    $conn = getConn();

    $idDesa = $_GET['id_des'];
    $sql = "SELECT nama_desa FROM desa WHERE id_desa = '$idDesa'";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $namaDesa = $row['nama_desa'];
    } 
?>
<div class="row">
    <div class="col-lg-12">
        <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Summary Desa <?= $namaDesa ?></h4>
                
            </div>
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <div class="dropdown">
                    <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                    <i class="ri-more-2-fill"></i>
                    </span>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                    <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                    <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                    <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                    <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="id_desa" value="<?= $_GET['id_des'] ?>">
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="tableDataVideo" class="table mb-0 table-borderless">
                    <thead>
                    <tr>
                        <th scope="col">NIK</th>
                        <th scope="col">Tanggal Upload</th>
                        <th scope="col">Nama Kecamatan</th>
                        <th scope="col">Nama Desa</th>
                        <th scope="col">Video</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
                <div class="col">                           
                        <nav aria-label="Page navigation example" style="margin-top: 20px;">
                        <ul class="pagination justify-content-end" id="pagination" style="cursor:pointer">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
        </div>
    </div>
</div>
