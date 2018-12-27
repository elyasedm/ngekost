<div class="featured">
    <div>
        <ul>
            <li><img src="images/home-1.jpg" alt=""/></li>
            <li><img src="images/home-2.jpg" alt=""/></li>		
        </ul>		
        <div class="section">
            <div>
            </div>	
        </div>
    </div>
</div>
<div class="home">
    <span class="heading"><a>Daftar Kost</a></span>
    <div>
        <ul class="home-list">
            <?php
            $gambar_kost = mysql_query("
                    SELECT kost.*,
                        pemilik.no_hp,
                        (SELECT lokasi 
                        FROM gambar_kost 
                        WHERE gambar_kost.kost_id = kost.id
                        AND type = 'cover' LIMIT 1) AS lokasi,
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
                        LEFT JOIN pemilik
                            ON pemilik.id = kost.pemilik_id
                    WHERE kost.aktif = 1
                    ORDER BY RAND() 
                    LIMIT 6");
            while ($r = mysql_fetch_array($gambar_kost)) {
                ?>
                <li>
                        <img src="
                        <?php
                        if (!empty($r['lokasi'])) {
                            echo 'images/small_' . $r['lokasi'];
                        } else {
                            echo 'images/na-135x135.jpg';
                        }
                        ?>
                             " alt="<?php echo $r['nama'] ?>"/>
                    <a href="?pages=detail_kost&id=<?php echo $r['id'] ?>">
                        <span>
                            <b><?php echo $r['nama'] ?></b><br/>
                            <?php echo $r['alamat'] ?><br/>
                            No. Handphone <?php echo $r['no_hp'] ?><br/>
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
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
        <h4><a href="?pages=kost">Lihat Semua Kosan</a></h4>
        <div style="clear:both"></div>
    </div>
</div>
