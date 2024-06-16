<div class="row">
    <div class="col-lg-12">
        <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Summary Data</h4>
                
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
        
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="tableDataVideo" class="table mb-0 table-borderless">
                    <thead>
                    <tr>
                        <th><input style="max-width: 150px;" type="text" id="filter-nik" placeholder="Filter NIK"></th>
                        <th><input style="width: 150px;" type="date" id="filter-upload-date" placeholder="Filter Upload Date"></th>
                        <th><input style="width: 150px;" type="text" id="filter-kecamatan" placeholder="Filter Kecamatan"></th>
                        <th><input style="width: 150px;" type="text" id="filter-desa" placeholder="Filter Desa"></th>
                        <th><input style="width: 150px;" type="text" id="filter-upload-by" placeholder="Upload By"></th>
                        <th scope="col"></th>
                        <th>
                            <button type="button" id="filter-button" onclick="getDataDesa()" class="btn btn-primary">Filter</button>
                            <button type="button" id="reset-button" onclick="resetFilter()" class="btn btn-secondary">Reset</button>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">NIK</th>
                        <th scope="col">Tanggal Upload</th>
                        <th scope="col">Nama Kecamatan</th>
                        <th scope="col">Nama Desa</th>
                        <th scope="col">Upload By</th>
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
