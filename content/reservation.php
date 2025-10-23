<?php 
include "koneksi/koneksi.php";

$querry = mysqli_query($koneksi, "SELECT reservasi.*, menu.nama_kopi FROM reservasi JOIN menu ON reservasi.id_menu = menu.id ORDER BY reservasi.id DESC");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM reservasi WHERE id ='$id'");
    header('location:?pg=reservation&hapus=berhasil');

}

if (isset($_POST['simpan'])) {
    $id_menu = $_POST['id_menu'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $jumlah_orang = $_POST['jumlah_orang'];
    //MASUKKAN KE DALAM TABEL reservasi (FIELD YANG AKAN DI MASUKKAN)
    //VALUE (INPUTAN MASING-MASING KOLOM)

    $insert = mysqli_query($koneksi, "INSERT INTO reservasi (nama_lengkap, email, id_menu, tanggal, waktu, jumlah_orang)
        VALUES ('$nama_lengkap','$email','$id_menu','$tanggal','$waktu','$jumlah_orang')");

    header('Location: ?pg=done-reservation&pesan=tambah-berhasil');

}
$queryreservasi = mysqli_query($koneksi, "SELECT * FROM reservasi ORDER BY id DESC")

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
                            <h1 class="text-white">Nikmati Diskon 20% untuk Reservasi Online</h1>
                        </div>
                        <p class="text-white">Pesan meja Anda sekarang dan nikmati hidangan terbaik kami dengan harga khusus. 
                            Proses reservasi mudah, cepat, dan penuh keuntungan!!.</p>
                        <ul class="list-inline text-white m-0">
                            <li>Keuntungan Reservasi Online : </li>
                            <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Prioritas Tempat Duduk
                                Terbaik</li>
                            <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Free Welcome Drink untuk
                                Setiap Reservasi</li>
                            <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Pelayanan Lebih Cepat &
                                Personal</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center p-5">
                        <h1 class="text-white mb-4 mt-5">Pesan Meja Anda</h1>
                        <form class="mb-5">
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
                                <button class="btn btn-primary btn-block font-weight-bold py-3" type="submit" name="simpan">PESAN
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