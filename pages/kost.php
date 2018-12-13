<div class="gallery">
   
    <?php
    require_once 'element/search_kost.php';
    ?>
    <div>
        <ul>
            <?php
            $batas = 10;
            $halaman = $_GET['page'];
            if (empty($halaman)) {
                $posisi = 0;
                $halaman = $no = 1;
            } else {
                $posisi = ($halaman - 1) * $batas;
                $no = $posisi + 1;
            }
            $gambar = mysql_query("
                SELECT DISTINCT kost.*,
                    (SELECT lokasi
                        FROM gambar_kost
                        WHERE gambar_kost.kost_id = kost.id
                        AND type = 'cover'
                        LIMIT 1) AS gambar,
                    (SELECT harga_kamar.harga
                        FROM harga_kamar
                            LEFT JOIN kamar
                                ON kamar.id = harga_kamar.kamar_id
                            LEFT JOIN periode
                                ON periode.id = harga_kamar.periode_id
                        WHERE kamar.kost_id = kost.id
                            AND periode.aktif = 1
                        ORDER BY type DESC 
                        LIMIT 1) AS harga_max,
                    (SELECT harga_kamar.type
                        FROM harga_kamar
                            LEFT JOIN kamar
                                ON kamar.id = harga_kamar.kamar_id
                            LEFT JOIN periode
                                ON periode.id = harga_kamar.periode_id
                        WHERE kamar.kost_id = kost.id
                            AND periode.aktif = 1
                        ORDER BY type DESC 
                        LIMIT 1) AS type_sewa,
                    (SELECT COUNT(jenis)
                        FROM kamar
                        WHERE kamar.kost_id = kost.id
                            AND kamar.jenis = 'P') AS putri,
                    (SELECT COUNT(jenis)
                        FROM kamar
                        WHERE kamar.kost_id = kost.id
                            AND kamar.jenis = 'L') AS putra
                    FROM kost 
                WHERE kost.aktif =1
                LIMIT $posisi,$batas");
            while ($r = mysql_fetch_array($gambar)) {
                ?>
                <li>
                    <a href="<?php echo '?pages=detail_kost&id=' . $r['id'] ?>">
                        <img src="
                        <?php
                        if (!empty($r['gambar'])) {
                            echo 'images/small_' . $r['gambar'];
                        } else {
                            echo 'images/na-135x135.jpg';
                        }
                        ?>
                             " alt="" /></a>
                    <span><a href="<?php echo '?pages=detail_kost&id=' . $r['id'] ?>"><?php echo $r['nama'] ?></a> <br>
                        <span>
                            <?php
                            if ($r['putra'] > 0 || $r['putri'] > 0) {
                                echo 'Kosan';
                                if ($r['putra'] > 0)
                                    echo ' Putra';
                                if ($r['putri'] > 0)
                                    echo ' Putri';
                            }
                            if (!empty($r['harga_max']))
                                echo '<br/>Harga Rp. ' . number_format($r['harga_max'], 2, ',', '.') . '/' . $r['type_sewa']
                                ?>
                        </span>
                    </span>
                    <?php
                }
                ?>
            </li>	
        </ul>	
    </div>
    <br>
    <?php
    $jum_kost = mysql_query('SELECT COUNT(*) FROM kost');
    $jumlah = mysql_fetch_array($jum_kost);
    $total_page = ceil($jumlah[0] / $batas);
    echo '<p>Halaman : ';
    for ($i = 1; $i <= $total_page; $i++) {
        if($i != $halaman){
            echo '<a href="?pages=kost&page=' . $i . '">' . $i . '</a> | ';
        }  else {
            echo '<b>'.$i.'</b> | ';
        }
    }
    echo '</p>';
    ?>
</div>
