<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
                    <form action="http://192.168.56.45/final-project/restapi.php?function=insert_penghuni" method="post">
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
                                      include 'connect.php';

                                      $api_url = 'http://192.168.56.45/final-project/restapi.php?function=get_penghuni';
                                      $content = file_get_contents($api_url);
                                      $data = json_decode($content, true);

                                      $penghuni = mysqli_query($conn, "SELECT * FROM finalproject");

                                      if ( count($data['data'] == 0 ) ) {
                                        for( $i = 1; $i <= 20 ;$i++) echo "<option value=\"".$i."\">".$i."</option>";
                                      } else {
                                        $id = array();
                                        foreach ($data['data'] as $d) {
                                          array_push($id,$d['kamar']);
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>                      
</body>
</html>