<div class="gallery">
    <h1>Daftar Kamar</h1>		
    <div>
        <?php
        $limit = 10;
        if (empty($_GET['page'])) {
            $page = 0;
        } else {
            $page = $_GET['page'] - 1;
        }
        $gambar = mysql_query("
                SELECT *,
                    (SELECT lokasi
                        FROM gambar_kamar
                        WHERE gambar_kamar.kamar_id = kamar.id
                        AND type = 'cover'
                        LIMIT 1) AS gambar,
                    (SELECT harga
                        FROM harga_kamar
                        LEFT JOIN periode
                                ON periode.id = harga_kamar.periode_id
                        WHERE harga_kamar.kamar_id = kamar.id
                        AND periode.aktif = 1
                        LIMIT 1) AS harga,
                     (SELECT COUNT(*) 
                        FROM harga_kamar
                        INNER JOIN pemesanan
                            ON pemesanan.harga_kamar_id = harga_kamar.id
                        WHERE harga_kamar.kamar_id = kamar.id
                        AND pemesanan.aktif = 1) AS status
                FROM kamar
                LIMIT $page,$limit");
        while ($r = mysql_fetch_array($gambar)) {
            $data[] = $r;
        }
        ?>
        <div>
            <a href="<?php echo '?pages=detail_kamar&id=' . $data[0]['id'] ?>"><img src="<?php if(!empty($data[0]['gambar'])) echo $data[0]['gambar']; else  echo 'images/na-447x456.jpg'; ?>" alt="" /></a>
            <span><a href="<?php echo '?pages=detail_kamar&id=' . $data[0]['id'] ?>"><?php echo $data[0]['nama'] ?></a><br>Harga <?php echo $data[0]['harga'] ?><br>
                <center>
                    <?php if ($data[0]['status'] == 0) { ?>
                        <a href="<?php echo '?pages=pesan&id=' . $data[0]['id'] ?>" class="button-h2">Pesan</a>
                    <?php } else { ?>
                        <b class="button-h2" style="width: 80%;background-color:#000;color: #FFF ">Sudah Dipesan</b></span>
            <?php } ?>
            </center>
            </span>
        </div>		
        <ul>
            <?php
            unset($data[0]);
            foreach ($data as $kamar) {
                ?>
                <li>
                    <a href="<?php echo '?pages=detail_kamar&id=' . $kamar['id'] ?>">
                    <img src="
                        <?php 
                        if(!empty($kamar['gambar'])){
                            echo $kamar['gambar'];
                        }else{
                            echo 'images/na-135x135.jpg';
                        }
                        ?>
                    " alt="" /></a>
                    <span style="height: 100px"><a href="<?php echo '?pages=detail_kamar&id=' . $kamar['id'] ?>"><?php echo $kamar['nama'] ?><a> <br>Harga <?php echo $kamar['harga'] ?><br/>
                                <?php if ($kamar['status'] == 0) { ?>
                                    <a href="<?php echo '?pages=pesan&id=' . $kamar['id'] ?>" class="button-h2" style="width: 100px">Pesan</a></span>
                                <?php } else { ?>
                                    <a href="#" class="button-h2" style="width: 100px">Sudah Dipesan</a></span>
                                <?php } ?>                
                                </li>	
                                <?php
                            }
                            ?>
                            </ul>	
                            </div>
                            <br>
                            <?php
                            $jum_kamar = mysql_query('SELECT COUNT(*) FROM kamar');
                            $jumlah = mysql_fetch_array($jum_kamar);
                            $total_page = ceil($jumlah[0] / $limit);
                            echo '<p>';
                            for ($i = 1; $i <= $total_page; $i++) {
                                echo '<a href="?pages=kamar&page=' . $i . '">' . $i . '</a> | ';
                            }
                            echo '</p>';
                            ?>
                            </div>
