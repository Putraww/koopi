<?php
// SIMPLE VERSION - Fokus pada insert saja
include "koneksi/koneksi.php";

if (isset($_POST['simpan'])) {
    echo "<h3>Debug Info:</h3>";
    
    // Tampilkan data POST
    echo "Data yang diterima:<br>";
    foreach ($_POST as $key => $value) {
        echo "$key: $value<br>";
    }
    
    // Simple insert
    $id_menu = $_POST['id_menu'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $jumlah_orang = $_POST['jumlah_orang'];
    
    $sql = "INSERT INTO pesan (nama_lengkap, email, id_menu, tanggal, waktu, jumlah_orang) 
            VALUES ('$nama_lengkap', '$email', '$id_menu', '$tanggal', '$waktu', '$jumlah_orang')";
    
    echo "SQL: $sql<br>";
    
    $result = mysqli_query($koneksi, $sql);
    
    if ($result) {
        echo "<h2 style='color:green'>✅ INSERT BERHASIL!</h2>";
        // header('Location: ?pg=done-reservation&pesan-tambah-berhasil');
        // exit;
    } else {
        echo "<h2 style='color:red'>❌ INSERT GAGAL!</h2>";
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!-- Reservation Start -->
<div class="container-fluid my-5">
    <div class="container">
        <div class="reservation position-relative overlay-top overlay-bottom">
            <div class="row align-items-center">
                <div class="col-lg-6 my-5 my-lg-0">
                    <div class="p-5">
                        <div class="mb-4">
                            <h1 class="display-3 text-primary">SELAMAT DATANG!</h1>
                            <h1 class="text-white">Nikmati Diskon 20% untuk pesan Online</h1>
                        </div>
                        <p class="text-white">Pesan meja Anda sekarang dan nikmati hidangan terbaik kami dengan harga khusus. 
                            Proses pesan mudah, cepat, dan penuh keuntungan!!.</p>
                        <ul class="list-inline text-white m-0">
                            <li>Keuntungan pesan Online : </li>
                            <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Prioritas Tempat Duduk
                                Terbaik</li>
                            <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Free Welcome Drink untuk
                                Setiap pesan</li>
                            <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Pelayanan Lebih Cepat &
                                Personal</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center p-5">
                        <h1 class="text-white mb-4 mt-5">Pesan Meja Anda</h1>
                        <form class="mb-5" method = "POST" action = "content/done-reservation.php">
                            <div class="form-group">
                                <input name="nama_lengkap" type="text" class="form-control bg-transparent border-primary p-4"
                                    placeholder="Nama Lengkap" required="required" style="color : white;" />
                            </div>
                            <div class="form-group">
                                <input name="email" type="email" class="form-control bg-transparent border-primary p-4"
                                    placeholder="Email Anda" required="required" style="color : white;"/>
                            </div>
                            <div class="form-group">
                                    <?php
                                    $queryOpt = mysqli_query($koneksi, "SELECT * FROM menu");
                                    ?>
                                    <select class="form-control" name="id_menu" id="id_menu">
                                        <option value="">--- Pilih Jenis Menu ---</option>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($queryOpt)):
                                            ?>
                                            <option value="<?= $row['id'] ?>">
                                                <?= $row['nama_kopi'] ?> |
                                                Harga :
                                                <?= $row['harga'] ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            <div class="form-group">
                                <div name="tanggal" class="date" id="date" data-target-input="nearest">
                                    <input type="date"
                                        class="form-control bg-transparent border-primary p-4 datetimepicker-input"
                                        data-target="#date" data-toggle="datetimepicker" style="color : white;"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div name="waktu" class="time" id="time" data-target-input="nearest">
                                    <input type="time"
                                        class="form-control bg-transparent border-primary p-4 datetimepicker-input"
                                        data-target="time" data-toggle="datetimepicker" style="color : white;"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="jumlah_orang" type="number" class="form-control bg-transparent border-primary p-4"
                                    placeholder="2" required="required" style="color : white;"/>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block font-weight-bold py-3" type="submit" name="simpan" href ="done-reservation.php">PESAN
                                    SEKARANG - DAPATKAN DISKON 20%</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Reservation End -->