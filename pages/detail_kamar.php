<?php
$gambar = mysql_query("
                        SELECT * 
                        FROM gambar_kamar
                        WHERE kamar_id = $_GET[id]
                            ");
$jum_image = mysql_num_rows($gambar);
if($jum_image > 0){
?>
<div style="position: relative;height: 330px;width: 620px;margin: 0 auto 50px;">
    <div id="slides" style="margin:40px 0 10px 60px">
        <div class="slides_container">
            <?php
            while ($r = mysql_fetch_array($gambar)) {
                if (!empty($r['lokasi'])) {
                    $img = 'images/medium_' . $r['lokasi'];
                } else {
                    $img = 'images/na-447x456.jpg';
                }
                ?>
                <div class="slide">
                    <a href="<?php echo $img ?>" title="<?php echo $r[keterangan] ?>" target="_blank"><img src="<?php echo $img ?>" width="570" height="270"></a>
                    <div class="caption" style="bottom:0">
                        <p><?php echo $r[keterangan] ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <a href="#" class="prev"><img src="img/arrow-prev.png" width="24" height="43" alt=""></a>
        <a href="#" class="next"><img src="img/arrow-next.png" width="24" height="43" alt=""></a>
    </div>
    <div style="clear: both"></div>
</div>
<?php } ?>

<div class="gallery">
    <?php
    $count_pemesanan = mysql_fetch_array(mysql_query('SELECT COUNT(id) AS count FROM pemesanan WHERE aktif =1 AND pelanggan_id='.$_SESSION['member']['id']));
    $profil = mysql_query("SELECT kamar.*,kamar.nama AS nama_kamar,kost.*,pemilik.nama AS nama_pemilik, pemilik.no_hp, kamar.keterangan AS keterangan_kamar FROM kamar LEFT JOIN kost ON kost.id = kamar.kost_id LEFT JOIN pemilik ON pemilik.id = kost.pemilik_id WHERE kamar.id=$_GET[id]");
    $data_kost = mysql_fetch_array($profil);
    
    $harga = mysql_query("
        SELECT harga_kamar.* 
        FROM harga_kamar 
        LEFT JOIN periode 
            ON periode.id = harga_kamar.periode_id
        WHERE periode.aktif = 1
        AND harga_kamar.kamar_id= $_GET[id]");
    ?>
    <h1>Data Kamar <?php echo $data_kost[nama_kamar] ?></h1>
    <?php if ($data_kost['status'] == 'kosong' && $count_pemesanan['count'] < 3 ) { ?>
        <a href="?pages=pesan&id=<?php echo $_GET[id] ?>" class="button-h2">Pesan Sekarang</a>
    <?php }elseif ($count_pemesanan['count'] >= 3) { ?>
        <a href="#" class="button-h2" onclick="alert('Anda belum melakukan pembayaran kamar kosan yang anda pesan, maksimal 3 kamar kosan yang dapat dipesan. Lakukan pembayaran salah satu kamar terlebih dahulu untuk melakukan pemesanan kembali.')">Pesan Sekarang</a>
        <?php } ?>
        <a href="?pages=detail_kost&id=<?php  echo $data_kost[kost_id]?>" class="button-h2 cancel">Kembali</a>
        <div style="clear: both"></div>
    <div class="content-table">
        <table>
            <tr><th width="135px">Nama Kamar</th><td><?php echo $data_kost[nama_kamar] ?></td><tr>
            <tr><th>Jenis</th><td><?php if($data_kost[jenis] == 'L'){ echo 'Putra';}else{ echo 'Putri';} ?></td><tr>
            <tr><th>Keterangan</th><td><?php echo $data_kost[keterangan_kamar] ?></td><tr>
            <tr><th>Harga</th><td>
                    <ul>
                    <?php
                    while ($r_harga = mysql_fetch_array($harga)) {
                        echo '<li style="list-style: square;margin:5px 10px 5px 14px;width:100%">Rp. '.number_format($r_harga['harga'],2,',','.') . '/' . $r_harga['type'] . '</li>';
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
                            echo '<li style="list-style: disc;margin:5px 10px 5px 14px;width:100%"><b>'.$r_fasilitas[nama].'</b><br/>';
                            echo $r_fasilitas[keterangan].'</li>';
                        }
                        ?>
                    </ul>
            </td><tr>
            <tr><th>Keterangan</th><td><?php echo $data_kost[keterangan] ?></td><tr>
        </table>
    </div>
</div>
<link type="text/css" rel="stylesheet" href="css/global.css"/>
<script src="js/slides.min.jquery.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function(){
        $('#slides').slides({
            preload: true,
            preloadImage: 'img/loading.gif',
            play: 5000,
            pause: 2500,
            hoverPause: true,
            animationStart: function(current){
                $('.caption').animate({
                    bottom:-35
                },100);
            },
            animationComplete: function(current){
                $('.caption').animate({
                    bottom:0
                },200);
            },
            slidesLoaded: function() {
                $('.caption').animate({
                    bottom:0
                },200);
            }
        });
    });
</script>