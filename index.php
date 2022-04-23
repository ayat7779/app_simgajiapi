<?php include 'page/header.php'; ?>
<div class="container">
  <div class="container">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col">
            <h1 style="color:blue;text-align:center;">Selamat Datang di WEB API</h1>
            <h2 style="color:valvet;text-align:center;">Sistem Manajemen Gaji PNSD Provinsi Riau</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
             <div class="card">
              <div class="card-header">
                <h3 class="card-title">WEB API SIMGAJI PNSD</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
			  <p style="color:black;text-align:justify;">API adalah singkatan dari <i>Programming Interface</i>, yaitu sebuah software yang memungkinkan para developer untuk mengintegrasikan dan mengizinkan dua aplikasi yang berbeda secara bersamaan untuk saling terhubung satu sama lain </p>
			  <p style="color:black;text-align:justify;">SIMGAJI PNSD merupakan aplikasi manajemen pengelolaan gaji ASN yang dibangun oleh PT. Taspen Persero yang membantu Pemerintah Daerah dalam mengelola gaji ASN.</p>
              </div>

              <div class="card-footer">
			  <h5 class="mt-2 text-muted">Web API</h5>
              <ul class="list-unstyled">
                <li>
                  <a href="http://localhost:90/simgajiapi/api.php?menu=getPegawai&nip=197907072010011031" class="btn-link text-secondary" target="_blank"><i class="far fa-fw fa-file-pdf"></i> Data Personal Pegawai</a>
                </li>
                <li>
                  <a href="http://localhost:90/simgajiapi/api.php?menu=getHubKeluarga&nip=197907072010011031" class="btn-link text-secondary" target="_blank"><i class="far fa-fw fa-envelope"></i> Data Keluarga ASN</a>
                </li>
                <li>
                  <a href="http://localhost:90/simgajiapi/api.php?menu=getGaji&nip=197907072010011031&gaji=2020-01-01" class="btn-link text-secondary" target="_blank"><i class="far fa-fw fa-image "></i> Rincian Gaji ASN</a>
                </li>
                <li>
                  <a href="http://localhost:90/simgajiapi/api.php?menu=getKDSatker" class="btn-link text-secondary" target="_blank"><i class="far fa-fw fa-file-word"></i> OPD Keseluruhan</a>
                </li>
                <li>
                  <a href="http://localhost:90/simgajiapi/api.php?menu=getNMSatker&kd=034" class="btn-link text-secondary" target="_blank"><i class="far fa-fw fa-file-pdf"></i> Identitas OPD</a>
                </li>
                <li>
                  <a href="http://localhost:90/simgajiapi/api.php?menu=getGajiSatker&kd=034&Tgaji=2020-01-01" class="btn-link text-secondary" target="_blank"><i class="far fa-fw fa-envelope"></i> Seluruh Gaji ASN pada OPD</a>
                </li>
                <li>
                  <a href="http://localhost:90/simgajiapi/api.php?menu=getGajiSatkerPersonal&kd=034&Tgaji=2020-01-01&nip=196503231993031003" class="btn-link text-secondary" target="_blank"><i class="far fa-fw fa-user"></i> Identitas ASN pada OPD tertentu</a>
                </li>
                <li>
                  <a href="http://localhost:90/simgajiapi/api.php?menu=getGajiPersonalView&Tgaji=2020-01-01&nip=197907072010011031" class="btn-link text-secondary" target="_blank"><i class="far fa-fw fa-file-excel"></i> Rincian Gaji ASN</a>
                </li>
              </ul>
              </div>
            </div>
           </div>
        </div>
      </div>
    </section>
  </div>

<?php
include 'page/footer.php';