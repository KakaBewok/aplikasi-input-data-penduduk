<?php
// variabel lokasi file db
$lokasiDataJSON = 'data.json';

// variabel penampung data array penduduk
$dataPenduduk = [];

// variabel mengambil isi dari db
$dataJSON = file_get_contents($lokasiDataJSON);

// variabel mengkonversi JSON db ke array PHP
$dataPenduduk = json_decode($dataJSON, true);

// logic ketika tombol submit ditekan
if(isset($_POST['submit'])){

  if($_POST['nama'] !== "" && 
  $_POST['nik'] !== "" && 
  $_POST['jk'] !== "" &&
  $_POST['alamat'] !== "" &&
  $_POST['hp'] !== "" &&
  $_POST['email'] !== ""){

    // data yang baru diinput
    $dataBaru = [
      "nama" => $_POST['nama'],
      "nik" => $_POST['nik'],
      "jk" => $_POST['jk'],
      "alamat" => $_POST['alamat'],
      "hp" => $_POST['hp'],
      "email" => $_POST['email']
    ];

  // data yang baru diinput dimasukan ke data penduduk
  array_push($dataPenduduk, $dataBaru);

  // data penduduk dikonversi lagi ke JSON
  $dataJSON = json_encode($dataPenduduk, JSON_PRETTY_PRINT);

  // data yang sudah dikonversi dimasukan kembali ke lokasi data JSON
  file_put_contents($lokasiDataJSON, $dataJSON);

  echo "<script>";
  echo "alert('Data anda tersimpan.');";
  echo "</script>";

  } else {
    echo "<script>";
    echo "alert('Data harus diisi dengan lengkap.');";
    echo "</script>";
  } 
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link href="./css/bootstrap.css" rel="stylesheet" />
    <style>
      @media screen and (max-width: 440px) {
        .hero-image {
          display: none;
        }
      }
    </style>
  </head>
  <body>
    <div class="container mt-5">
      <!-- form input -->
      <div class="row">
        <div class="col-sm-6">
          <h2>Input Data Penduduk</h2>
          <form action="index.php" method="post" class="mt-5">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama" name="nama" />
            </div>
            <div class="mb-3">
              <label for="nik" class="form-label">No. NIK</label>
              <input
                type="number"
                class="form-control"
                id="nik"
                name="nik"
                placeholder="Masukan 16 digit NIK"
              />
            </div>
            <div class="mb-3">
              <label for="jk" class="form-label">Jenis Kelamin</label>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="jk"
                  id="jkl"
                  value="Laki-laki"
                />
                <label class="form-check-label" for="jkl"> Laki-laki </label>
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="jk"
                  id="jkp"
                  value="Perempuan"
                />
                <label class="form-check-label" for="jkp"> Perempuan </label>
              </div>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <input
                type="text"
                class="form-control"
                id="alamat"
                name="alamat"
                placeholder="Sebutkan Kota/Kabupaten dan Kecamatan"
              />
            </div>
            <div class="mb-3">
              <label for="hp" class="form-label">No. HP</label>
              <input type="tel" class="form-control" id="hp" name="hp" />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">E-mail</label>
              <input
                type="email"
                class="form-control"
                id="email"
                name="email"
              />
            </div>
            <button
              type="submit"
              class="btn btn-primary"
              name="submit"
              value="submit"
            >
              Submit
            </button>
          </form>
        </div>
        <div class="col-sm-6 align-self-center hero-image">
          <img src="./img/hero-icon.png" alt="Hero Image" width="550px" style="margin-left: 35px">
        </div>
      </div>
      <!-- tabel menampilkan hasil input -->
      <hr>
      <div class="row mt-5 mb-5">
        <div class="col-sm-12">
          <div class="table-responsive">
            <h2 class="text-center">Data Penduduk</h2>
            <table class="table table-striped mt-5">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Nama Lengkap</th>
                  <th scope="col">NIK</th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">No. HP</th>
                  <th scope="col">E-mail</th>
                </tr>
              </thead>
      <?php
                for($i = 0; $i < count($dataPenduduk); $i++){
                $namaBaru = $dataPenduduk[$i]["nama"];
                $nikBaru = $dataPenduduk[$i]["nik"];
                $jkBaru = $dataPenduduk[$i]["jk"];
                $alamataru = $dataPenduduk[$i]["alamat"];
                $hpBaru = $dataPenduduk[$i]["hp"];
                $emailBaru = $dataPenduduk[$i]["email"];
                $plus = 1;
                
                echo "<tbody>";
                echo "<tr>";
                echo "<th scope='row'>". $i + $plus."</th>";
                echo "<td>{$namaBaru}</td>";
                echo "<td>{$nikBaru}</td>";
                echo "<td>{$jkBaru}</td>";
                echo "<td>{$alamataru}</td>";
                echo "<td>{$hpBaru}</td>";
                echo "<td>{$emailBaru}</td>";
                echo "</tr>";
                echo "</tbody>";
                }
      ?>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script src="./js/bootstrap.js"></script>
  </body>
</html>
