<h2>Data Pembayaran</h2>
<script type="text/javascript">
    $('.search-check').live('click',function(){
        $('#search_panel').hide();
        if($(this).val() == 'ya'){
            $('#search_panel').show();
        }
    });
</script>
<div class="half" style="margin-bottom: 10px;">
    <b>Cari Data Pembayaran :</b> 
    <input type="radio" name="check" class="search-check" value="ya"/>Ya
    <input type="radio" name="check" class="search-check" value="tidak" checked="checked"/>Tidak    
</div>
<div style="width: 100%;margin-bottom: 10px;display: none;" id="search_panel">
    <form method="get" action="media.php">
        <input type="hidden" name="page" value="<?php echo $_GET['page'] ?>"/>
        Tanggal : 
        <input type="text" name="tanggal" value="<?php echo $_GET['tanggal'] ?>" size="8" id="tanggal"/>
        Jenis : 
        <select name="jenis">
            <option value="%" <?php if ($_GET['jenis'] == '%') echo 'selected="selected"'; ?>>Semua</option>
            <option value="DP" <?php if ($_GET['jenis'] == 'DP') echo 'selected="selected"'; ?>>DP</option>
            <option value="cicilan" <?php if ($_GET['jenis'] == 'cicilan') echo 'selected="selected"'; ?>>Cicilan</option>
            <option value="lunas" <?php if ($_GET['jenis'] == 'lunas') echo 'selected="selected"'; ?>>Lunas</option>
        </select>
        Bank :
        <select name="bank">
            <option value="%">Semua</option>
            <?php
            $bank = mysql_query('SELECT * FROM bank');
            while ($r_bank = mysql_fetch_array($bank)) {
                if ($r_bank[id] == $_GET['bank']) {
                    echo '<option value="' . $r_bank[id] . '" selected="selected">' . $r_bank[nama] . '</option>';
                } else {
                    echo '<option value="' . $r_bank[id] . '">' . $r_bank[nama] . '</option>';
                }
            }
            ?>
        </select>
        Konfirmasi : 
        <select name="konfirmasi">
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
        <th>Nama</th>
        <th>Tanggal Transfer</th>
        <th>Tanggal Transaksi</th>
        <th>Jumlah</th>
        <th>Bank Tujuan</th>
        <th>Kode Transfer</th>
        <th>Type Bayar</th>
        <th>Aksi</th>
    </tr> 
    <?php
    if (count($_GET) > 1) {
        $condition = 'pembayaran.tgl_transaksi LIKE "%' . $_GET['tanggal'] . '%" 
                AND pembayaran.type LIKE "%' . $_GET['jenis'] . '%"
                AND pembayaran.bank_id LIKE "%' . $_GET['bank'] . '%"
                AND pembayaran.konfirmasi LIKE "%' . $_GET['konfirmasi'] . '%"';
    } else {
        $condition = 'pembayaran.konfirmasi = 0';
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
        SELECT pelanggan.nama,
            pembayaran.*,
            bank.nama as nama_bank
        FROM pembayaran
            LEFT JOIN pemesanan
                ON pemesanan.id = pembayaran.pemesanan_id
            LEFT JOIN bank 
                ON bank.id = pembayaran.bank_id
            LEFT JOIN pelanggan
                ON pelanggan.id = pemesanan.pelanggan_id
        WHERE $condition LIMIT $posisi,$batas");
    $no = 1;
    while ($r = mysql_fetch_array($tampil)) {
        echo "<tr>
            <td>$no</td>
            <td>$r[nama]</td>
            <td>$r[tanggal]</td>
            <td>$r[tgl_transaksi]</td>
            <td align='right'>Rp. " . number_format($r[jumlah], 2, ',', '.') . "</td>
            <td>$r[nama_bank]</td>
            <td>$r[kode_transfer]</td>
            <td>$r[type]</td>
            <td>";
        if(!$r[konfirmasi]){
            echo "<a href='modul/$_GET[page]/aksi.php?act=konfirmasi&id=$r[id]'>Konfirmasi</a></td>";
        }
        echo "</tr>";
        $no++;
    }
    ?>
</table>
<?php
    $count = mysql_fetch_array(mysql_query("SELECT COUNT(pembayaran.id) FROM pembayaran WHERE $condition"));
    $total_page=ceil($count[0]/$batas);
    echo 'Halaman : ';
    for($i = 1; $i <= $total_page; $i++){
        if($i != $halaman){
            echo '<a href="media.php?page='.$_GET[page].'&p='.$i.'&tanggal=' . $_GET['tanggal'] . '&jenis=' . $_GET['jenis'] . '&bank=' . $_GET['bank'] . '&konfirmasi=' . $_GET['konfirmasi'] . '"> '.$i.'</a> | ';
        }  else {
            echo '<b>'.$i.'</b> | ';
        }
    }
?>
