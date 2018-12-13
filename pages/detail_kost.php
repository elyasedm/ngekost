<?php
$gambar = mysql_query("
                        SELECT * 
                        FROM gambar_kost
                        WHERE kost_id = $_GET[id]
                            ");
$jum_image = mysql_num_rows($gambar);
if ($jum_image > 0) {
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
            <a href="#" class="prev"><img src="img/arrow-prev.png" width="24" height="24" alt=""></a>
            <a href="#" class="next"><img src="img/arrow-next.png" width="24" height="24" alt=""></a>
        </div>
        <div style="clear: both"></div>
    </div>
    <?php
}
?>

<div class="gallery">
    <?php
    $profil = mysql_query("SELECT kost.*,pemilik.nama AS nama_pemilik, pemilik.no_hp FROM kost LEFT JOIN pemilik ON pemilik.id = kost.pemilik_id WHERE kost.id=$_GET[id]");
    $data_kost = mysql_fetch_array($profil);
    ?>
    <a href="?pages=kost" class="button-h2 cancel">Kembali</a>
    <div style="clear: both"></div>
    <div class="content-table">
        <table>
            <tr><th width="135px">Nama Kosan</th><td><?php echo $data_kost[nama] ?></td><tr>
            <tr><th>Alamat</th><td><?php echo $data_kost[alamat] ?></td><tr>
            <tr><th>Pemilik</th><td><?php echo $data_kost[nama_pemilik] ?></td><tr>
            <tr><th>No. Telepon</th><td><?php echo $data_kost[no_hp] ?></td><tr>
            <tr><th>Fasilitas</th><td>
                    <ul>
                        <?php
                        $fasilitas = mysql_query('SELECT fasilitas.* FROM fasilitas_kost LEFT JOIN fasilitas ON fasilitas.id = fasilitas_kost.fasilitas_id WHERE fasilitas_kost.kost_id=' . $_GET[id]);
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
    <h2>Daftar Kamar Kost <?php echo $data_kost[nama] ?></h2>
    <div>
        <ul>
            <?php
            $kamar = mysql_query("
                SELECT *,
                    (SELECT lokasi FROM gambar_kamar WHERE kamar_id = kamar.id ORDER BY RAND() LIMIT 1) AS gambar,
                    (SELECT harga FROM harga_kamar LEFT JOIN periode ON periode.id = harga_kamar.periode_id WHERE kamar_id = kamar.id AND periode.aktif = 1 ORDER BY harga_kamar.type DESC LIMIT 1) AS harga,
                    (SELECT type FROM harga_kamar LEFT JOIN periode ON periode.id = harga_kamar.periode_id WHERE kamar_id = kamar.id AND periode.aktif = 1 ORDER BY harga_kamar.type DESC LIMIT 1) AS type
                FROM kamar
                WHERE kost_id = $_GET[id]
            ");
            while ($r_kamar = mysql_fetch_array($kamar)) {
                ?>
                <li>
                    <a href="<?php echo '?pages=detail_kamar&id=' . $r_kamar['id'] ?>"><img src="
                        <?php
                        if (!empty($r_kamar['gambar'])) {
                            echo 'images/small_' . $r_kamar['gambar'];
                        } else {
                            echo 'images/na-135x135.jpg';
                        }
                        ?>
                                                                                            " alt="" /></a>
                    <span><a href="<?php echo '?pages=detail_kamar&id=' . $r_kamar['id'] ?>"><?php echo $r_kamar['nama'] ?><a> <br>
                                <?php
                                if (!empty($r_kamar['harga']))
                                    echo '<span>Kamar ';
                                if ($r_kamar['jenis'] == 'L') {
                                    echo 'Putra';
                                } else {
                                    echo 'Putri';
                                }
                                echo '<br/>Harga Rp. ' . number_format($r_kamar['harga'], 2, '.', ',') . '/' . $r_kamar['type'].'<br/>';
                                echo 'Status : '.  ucwords($r_kamar['status'].'</span>');
                                ?>
                                </span>
                                </li>	
                                <?php
                            }
                            ?>
                            </ul>	
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