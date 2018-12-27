<?php
    $kost = mysql_fetch_array(mysql_query('SELECT kost.id FROM kamar LEFT JOIN kost ON kost.id = kamar.kost_id WHERE kamar.id = '.$_GET[id]));
?>
<h2>Data Pemesanan</h2>
<input type=button class='tombol' value=Kembali onclick="window.location = 'media.php?page=kamar&id=<?php echo $kost[id] ?>' "/>
<div class="clear"></div>
<table>
    <tr>
        <th>No</th>
        <th>Nama Kamar</th>
        <th>Nama Kost</th>
        <th>Nama Pemilik</th>
        <th>Harga</th>
        <th>Tanggal Masuk</th>
        <th>Tanggal Pemesanan</th>
        <th>Nama Pemesan</th>
        <th>Aksi</th>
    </tr> 
    <?php
    $batas=10;
    $halaman=$_GET['p'];
    if(empty($halaman)){
        $posisi=0;
        $halaman = $no =1;    
    }else{
        $posisi = ($halaman-1) * $batas;
        $no = $posisi + 1;
    }

    $tampil = mysql_query("
        SELECT kamar.nama AS nama_kamar,
            kost.nama AS nama_kost,
            pemilik.nama AS nama_pemilik,
            harga_kamar.harga,
            harga_kamar.type,
            pemesanan.tgl_masuk,
            pemesanan.tanggal,
            pelanggan.nama AS nama_pelanggan,
            pemesanan.id
        FROM pemesanan
            LEFT JOIN harga_kamar
                ON harga_kamar.id = pemesanan.harga_kamar_id
            LEFT JOIN kamar
                ON kamar.id = harga_kamar.kamar_id
            LEFT JOIN kost
                ON kost.id = kamar.kost_id
            LEFT JOIN pemilik
                ON pemilik.id = kost.pemilik_id
            LEFT JOIN pelanggan
                ON pelanggan.id = pemesanan.pelanggan_id
        WHERE kamar.id = $_GET[id]
        ORDER BY pemesanan.tanggal DESC LIMIT $posisi,$batas");
    while ($r = mysql_fetch_array($tampil)) {
        echo "<tr>
            <td>$no</td>
            <td>$r[nama_kamar]</td>
            <td>$r[nama_kost]</td>
            <td>$r[nama_pemilik]</td>
            <td>Rp. " . number_format($r[harga], 2, ',', '.') . " / $r[type]</td>
            <td>$r[tgl_masuk]</td>
            <td>$r[tanggal]</td>
            <td>$r[nama_pelanggan]</td>
            <td><a href='?page=pembayaran_kamar&id=$r[id]&kamar_id=$_GET[id]'>Detail Pembayaran</a></td>
		</tr>";
        $no++;
    }
    ?>
</table>
<?php
    $count = mysql_fetch_array(mysql_query("SELECT COUNT(pemesanan.id) 
        FROM pemesanan 
            LEFT JOIN harga_kamar
                ON harga_kamar.id = pemesanan.harga_kamar_id
        WHERE harga_kamar.kamar_id = $_GET[id]
"));
    $total_page=ceil($count[0]/$batas);
    echo 'Halaman : ';
    for($i = 1; $i <= $total_page; $i++){
        if($i != $halaman){
            echo '<a href="media.php?page='.$_GET[page].'&p='.$i.'</a> | ';
        }  else {
            echo '<b>'.$i.'</b> | ';
        }
    }
?>
