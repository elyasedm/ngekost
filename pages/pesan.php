<?php
$profil = mysql_query("SELECT kamar.*,kamar.nama AS nama_kamar,kost.*,pemilik.nama AS nama_pemilik, pemilik.no_hp, kamar.keterangan AS keterangan_kamar FROM kamar LEFT JOIN kost ON kost.id = kamar.kost_id LEFT JOIN pemilik ON pemilik.id = kost.pemilik_id WHERE kamar.id=$_GET[id]");
$data_kost = mysql_fetch_array($profil);

if (!isset($_SESSION['member'])) {
    ?>
    <script>
        window.location.href = 'index.php?pages=login&url='+encodeURIComponent(document.URL);
    </script>
    <?php
}
?>
<div class="gallery">
    <h1>Pesan Kamar</h1>
    <?php
    $harga = mysql_query("
        SELECT harga_kamar.* 
        FROM harga_kamar 
        LEFT JOIN periode 
            ON periode.id = harga_kamar.periode_id
        WHERE periode.aktif = 1
        AND harga_kamar.kamar_id= $_GET[id]");
    ?>
    <a href="?pages=detail_kamar&id=<?php echo $_GET[id] ?>" class="button-h2 cancel">Kembali</a>
    <div style="clear: both"></div>
    <div class="content-table">
        <table>
            <tr><th width="135px">Nama Kamar</th><td><?php echo $data_kost[nama_kamar] ?></td><tr>
            <tr><th>Jenis</th><td><?php
    if ($data_kost[jenis] == 'L') {
        echo 'Putra';
    } else {
        echo 'Putri';
    }
    ?></td><tr>
            <tr><th>Keterangan</th><td><?php echo $data_kost[keterangan_kamar] ?></td><tr>
            <tr><th>Harga</th><td>
                    <ul>
                        <?php
                        while ($r_harga = mysql_fetch_array($harga)) {
                            echo '<li style="list-style: square;margin:5px 10px 5px 14px;width:100%">Rp. ' . number_format($r_harga['harga'], 2, ',', '.') . '/' . $r_harga['type'] . '</li>';
                        }
                        ?>
                    </ul>
                </td></tr>
        </table>
        <table>
            <tr><th width="135px">Nama Kosan</th><td><?php echo $data_kost[nama] ?></td><tr>
            <tr><th>Alamat</th><td><?php echo $data_kost[alamat] ?></td><tr>
            <tr><th>Pemilik</th><td><?php echo $data_kost[nama_pemilik] ?></td><tr>
            <tr><th>No. Telepon</th><td><?php echo $data_kost[no_hp] ?></td><tr>
            <tr><th>Fasilitas</th><td>
                    <ul>
                        <?php
                        $fasilitas = mysql_query('SELECT fasilitas.* FROM fasilitas_kost LEFT JOIN fasilitas ON fasilitas.id = fasilitas_kost.fasilitas_id WHERE fasilitas_kost.kost_id=' . $data_kost[kost_id]);
                        while ($r_fasilitas = mysql_fetch_array($fasilitas)) {
                            echo '<li style="list-style: disc;margin:5px 10px 5px 14px;width:100%"><b>' . $r_fasilitas[nama] . '</b><br/>';
                            echo $r_fasilitas[keterangan] . '</li>';
                        }
                        ?>
                    </ul>
                </td><tr>
            <tr><th>Keterangan</th><td><?php echo $data_kost[keterangan] ?></td><tr>
        </table>
    </div>
    <form method="post" action="action/pesan.php?kamar=<?php echo $_GET[id] ?>">
        <div id="body-content" class="content-table"></div>
        <?php
        $harga = mysql_query("
            SELECT harga_kamar.* 
            FROM harga_kamar 
            LEFT JOIN periode 
                ON periode.id = harga_kamar.periode_id
            WHERE periode.aktif = 1
            AND harga_kamar.kamar_id= $_GET[id]");
        ?>
        <br/><br/>
        <label for="jenis">Pilih Jenis Kamar</label> <select name="jenis" id="jenis">
            <?php
            while ($r_harga = mysql_fetch_array($harga)) {
                echo "<option value='$r_harga[id]'>Rp. " . number_format($r_harga[harga], 2, ',', '.') . " / $r_harga[type]</option>";
            }
            ?>
        </select>
        <br/><br/>
        <label for="masuk">Tanggal Masuk</label>
        <input type="text" id="datepicker" name="masuk" readonly="readonly"/>
        <br/><br/>
        <input type="submit" value="Pesan"/>
    </form>
</div>
