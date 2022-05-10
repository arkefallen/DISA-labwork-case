<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Style -->
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <title>Daftar Penghuni Kos</title>
  </head>
  <body>
  <?php
    $api_url = 'https://api.quotable.io/quotes';
    $content = file_get_contents($api_url);
    $data = json_decode($content, true);
    $concatedString = "";

    foreach ($data['results'] as $quote) {
      $concatedString .= " ".$quote['content']." -".$quote['author']." |";
    }

    echo "<div class=\"quote-container\"> <marquee direction=\"left\" height=\"20px\">".$concatedString."</marquee> </div>";
  ?>
    
    <div class="container-sm title w-50">
      <h1>Kos Makmur Sekali</h1>
    </div>
    <div class="bg-backdrop container-sm">
      <div class="container bg-data">
        <div class="container input-place">
        
                  <!-- Button trigger modal -->
                  <a class="btn btn-info" href="index.php" style="margin-right: 10px;">
                    Lihat Kos Sebelah
                  </a>
                  <a type="button" href="tambah.php" class="btn btn-primary" style="margin-right: 10px;">
                    <i class='bx bxs-user-plus' style='color:#ffffff'></i>
                    Tambah Penghuni
                  </a>
                  <a class="btn btn-secondary" style="color: white; margin-right:10px;" href="edit-makmur.php">
                    <i class='bx bxs-edit-alt' style='color:#ffffff'></i>
                    Ubah Data
                  </a>

                  <!-- Modal -->
                  <!-- <div class="modal fade" id="deleteDataModal" tabindex="-1" aria-labelledby="deleteDataModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="deleteDataModalLabel">Siapa yang keluar dari kos ?</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="http://192.168.56.45/final-project/api/penghuni.php?room=
                            <?php 
                              
                            ?>" 
                            method="POST">
                            <select class="form-select mb-3" aria-label="Pilih Penghuni" name="penghuni" id="penghuni" onclick="changePreview(this)">
                              <option value="-">Pilih penghuni yang keluar</option>
                              <?php

                                // $api_url = 'http://192.168.56.45/final-project/api/penghuni.php';
                                // $content = file_get_contents($api_url);
                                // $data = json_decode($content, true);

                                // if ( $data['data'] > 0 ) {

                                //   foreach ($data['data'] as $penghuni) {
                                //     echo "<option data-value='{\"id\":\"".$penghuni['id']."\",\"nama\":\"".$penghuni['nama']."\",\"asal\":\"".$penghuni['asal']."\",\"kampus\":\"".$penghuni['kampus']."\",\"no_hp\":\"".$penghuni['no_hp']."\",\"kamar\":\"".$penghuni['kamar']."\"}'>".$penghuni['nama']." di kamar no ".$penghuni['kamar']."</option>";
                                //   }

                                // } else {
                                //   echo "<script> alert('Tidak ada data !') </script>";
                                // }
                              ?>
                            </select>
                            <div class="mb-3">
                              <label for="name" class="form-label">Nama</label>
                              <input id="name" type="text" class="form-control" name="name" aria-describedby="nameInfo" placeholder="Nama penghuni yang akan keluar" readonly>
                            </div>
                            <div class="mb-3">
                              <label for="room" class="form-label">Kamar</label>
                              <input id="room" type="text" class="form-control" name="room" aria-describedby="roomInfo" placeholder="No kamar penghuni" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-danger" name="submit">Hapus Penghuni</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div> -->

                  <div class="modal fade" id="insertDataModal" tabindex="-1" aria-labelledby="insertDataModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="insertDataModalLabel">Tambah Penghuni Kos</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="http://192.168.56.45/final-project/api/penghuni.php" method="POST">
                            <div class="mb-3">
                              <label for="name" class="form-label">Nama</label>
                              <input type="text" class="form-control" name="name" aria-describedby="nameInfo" placeholder="Masukkan nama lengkap penghuni">
                            </div>
                            <div class="mb-3">
                              <label for="city" class="form-label">Asal</label>
                              <input type="text" class="form-control" name="city" aria-describedby="cityInfo" placeholder="Masukkan asal daerah penghuni">
                            </div>
                            <div class="mb-3">
                              <label for="campus" class="form-label">Kampus</label>
                              <input type="text" class="form-control" name="campus" aria-describedby="campusInfo" placeholder="Masukkan dimana penghuni berkuliah">
                            </div>
                            <div class="mb-3">
                              <label for="phone" class="form-label">No HP</label>
                              <input type="text" class="form-control" name="phone" aria-describedby="phoneInfo" placeholder="Masukkan no HP penghuni yang akt0if" maxlength="15">
                            </div>
                            <div class="mb-3">
                              <label for="room" class="form-label">Kamar</label>
                              <select class="form-select" aria-label="Room Select" name="room">
                                  <option selected>Pilih kamar yang ditempati penghuni</option>
                                  <?php

                                      $api_url = 'http://192.168.56.45/final-project/api/penghuni.php';
                                      $content = file_get_contents($api_url);
                                      $data = json_decode($content, true);

                                      if ( count($data['data']) == 0 ) {
                                        for( $i = 1; $i <= 20 ;$i++) echo "<option value=\"".$i."\">".$i."</option>";
                                      } else {
                                        $id = array();
                                        foreach ($data['data'] as $value) {
                                          array_push($id,$value['kamar']);
                                        }
                                        for( $j = 1; $j <= 20; $j++ ) {
                                          if ( in_array($j, $id) ) continue;
                                          else echo "<option value=\"".$j."\">".$j."</option>";
                                        }
                                      }
                                  ?>
                              </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                          <button type="submit" name="submit" class="btn btn-primary">Masukkan Data</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              <div class="container data-view">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Asal</th>
                      <th scope="col">Kampus</th>
                      <th scope="col">No HP</th>
                      <th scope="col">Kamar</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    include "connect.php";

                    $api_url = 'http://192.168.56.45/final-project/api/penghuni.php';
                    $content = file_get_contents($api_url);
                    $data = json_decode($content, true);

                    $i = 1;
                    foreach ($data['data'] as $d) {
                        echo "
                        <tr>
                            <td>$i</td>
                            <td>".$d['nama']."</td>
                            <td>".$d['alamat']."</td>
                            <td>".$d['kampus']."</td>
                            <td>".$d['no_hp']."</td>
                            <td>".$d['kamar']."</td>
                            <td>
                              <form action=\"http://192.168.56.45/final-project/api/penghuni.php?room=".$d['kamar']."\" method=\"post\">
                                <button type=\"submit\" class=\"btn btn-danger\" >
                                  <i class='bx bxs-trash' style='color:#ffffff'></i>
                                </button>
                              </form>
                            </td>
                        </tr>
                        ";
                        $i++;
                    }

                  ?>
                  </tbody>
                </table>
            </div>
        </div>
      </div>
      </div>
    <script>
        function changePreview(event) {
            const penghuni = document.getElementById('penghuni');
            let selectedPenghuni = event.selectedOptions[0].getAttribute('data-value');
            let penghuniObj = JSON.parse(selectedPenghuni);
            
            let inputName = document.getElementById('name');
            let inputKamar = document.getElementById('room');

            inputName.value = penghuniObj["nama"];
            inputKamar.value = penghuniObj["kamar"];
        }
    </script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>
</html>