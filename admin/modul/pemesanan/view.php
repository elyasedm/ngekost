<h2>Data Pemesanan</h2>
<script type="text/javascript">
    $('.search-check').live('click',function(){
        $('#search_panel').hide();
        if($(this).val() == 'ya'){
            $('#search_panel').show();
        }
    });
</script>
<div class="half" style="margin-bottom: 10px;">
    <b>Cari Data Pemesanan :</b> 
    <input type="radio" name="check" class="search-check" value="ya"/>Ya
    <input type="radio" name="check" class="search-check" value="tidak" checked="checked"/>Tidak    
</div>
<div style="width: 100%;margin-bottom: 10px;display: none;" id="search_panel">
    <form method="get" action="media.php">
        <input type="hidden" name="page" value="<?php echo $_GET['page'] ?>"/>
        Tanggal : 
        <input type="text" name="tanggal" value="<?php echo $GET['tanggal'] ?>" size="6" id="tanggal"/>
        Kamar : 
        <input type="text" name="kamar" value="<?php echo $_GET['kamar'] ?>" size="6"/>
        Pelanggan : 
        <input type="text" name="pelanggan" value="<?php echo $_GET['pelanggan'] ?>" size="6"/>
        Jenis Sewa : 
        <select name="jenis">
            <option value="%" <?php if ($_GET['jenis'] == '%') echo 'selected="selected"'; ?>>Semua</option>
            <option value="bulan" <?php if ($_GET['jenis'] == 'bulan') echo 'selected="selected"'; ?>>Bulan</option>
            <option value="6 bulan" <?php if ($_GET['jenis'] == '6 bulan') echo 'selected="selected"'; ?>>6 Bulan</option>
            <option value="tahun" <?php if ($_GET['jenis'] == 'tahun') echo 'selected="selected"'; ?>>Tahun</option>
        </select>
        Aktif : 
        <select name="aktif">
            <option value="%" <?php if ($_GET['jenis'] == '%') echo 'selected="selected"'; ?>>Semua</option>
            <option value="1" <?php if ($_GET['jenis'] == '1') echo 'selected="selected"'; ?>>Ya</option>
            <option value="0" <?php if ($_GET['jenis'] == '0') echo 'selected="selected"'; ?>>Tidak</option>
        </select>
        <input type="submit" value="Cari"/>
    </form>
</div>
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
    if (count($_GET) > 1) {
        $condition = 'pemesanan.tanggal LIKE "%' . $_GET['tanggal'] . '%" 
                AND kamar.nama LIKE "%' . $_GET['kamar'] . '%"
                AND pelanggan.nama LIKE "%' . $_GET['pelanggan'] . '%"
                AND harga_kamar.type LIKE "%' . $_GET['jenis'] . '%"
                AND pemesanan.aktif LIKE "%' . $_GET['aktif'] . '%"';
    } else {
        $condition = 'pemesanan.aktif = 1';
    }
    
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
        WHERE $condition
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
            <td><a href='?page=detail_pemesanan&id=$r[id]'>Detail Pembayaran</a></td>
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
            LEFT JOIN kamar
                ON kamar.id = harga_kamar.kamar_id
            LEFT JOIN pelanggan
                ON pelanggan.id = pemesanan.pelanggan_id
        WHERE $condition"));
    $total_page=ceil($count[0]/$batas);
    echo 'Halaman : ';
    for($i = 1; $i <= $total_page; $i++){
        if($i != $halaman){
            echo '<a href="media.php?page='.$_GET[page].'&p='.$i.'&tanggal=' . $_GET['tanggal'] . '&kamar=' . $_GET['kamar'] . '&pelanggan=' . $_GET['pelanggan'] . '&jenis=' . $_GET['jenis'] . '&aktif=' . $_GET['aktif'] . '"> '.$i.'</a> | ';
        }  else {
            echo '<b>'.$i.'</b> | ';
        }
    }
?>
