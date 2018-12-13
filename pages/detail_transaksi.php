<div class="contact">
    <h1>Detail Transaksi <?php echo $_SESSION['member']['nama'] ?></h1>
    <div class="content-table">
        <table style="width: 400px">
            <?php
            $up = mysql_query('
                UPDATE pembayaran 
                SET pembayaran.read = 1 
                WHERE pemesanan_id='.$_GET['id']);
            
            $transaksi = mysql_query("
            SELECT pemesanan.*,
                pelanggan.nama AS nama_pemesan,
                pelanggan.email,
                kamar.id AS id_kamar,
                kamar.nama AS nama_kamar,
                kost.id AS id_kost,
                kost.nama AS nama_kost,
                harga_kamar.harga,
                harga_kamar.type,
                SUM(pembayaran.jumlah) AS jumlah
            FROM pemesanan
                LEFT JOIN pembayaran
                    ON pembayaran.pemesanan_id = pemesanan.id
                INNER JOIN harga_kamar
                    ON harga_kamar.id = pemesanan.harga_kamar_id
                INNER JOIN kamar
                    ON kamar.id = harga_kamar.kamar_id
                INNER JOIN kost
                    ON kost.id = kamar.kost_id
                INNER JOIN pelanggan
                    ON pemesanan.pelanggan_id = pelanggan.id
            WHERE pemesanan.id = $_GET[id]
            GROUP BY pemesanan.id
                ");
            $r = mysql_fetch_array($transaksi);
            ?>
            <tr>
                <th width="150px">id pemesanan</th>
                <td><?php echo $r['id'] ?></td>
            </tr>
            <tr>
                <th>tanggal pemesanan</th>
                <td><?php echo $r['tanggal'] ?></td>
            </tr>
            <tr>
                <th>kamar (kosan)</th>
                <td><a href="?pages=detail_kamar&id= <?php echo $r['id_kamar'] ?>"><?php echo $r['nama_kamar'] ?></a> (<a href="?pages=detail_kost&id=<?php echo $r['id_kost'] ?>"><?php echo $r['nama_kost'] ?></a>)</td>
            </tr>
            <tr>
                <th>harga</th>
                <td align='right'>Rp. <?php echo number_format($r['harga'], 2, ',', '.') . " / " . $r['type'] ?></td>
            </tr>
            <tr>
                <th>Belum Dibayar</th>
                <td align='right'>Rp. <?php echo number_format(($r['harga'] - $r['jumlah']), 2, ',', '.') ?></td>
            </tr>
            <tr>
                <th>Sudah dibayar</th>
                <td align='right'>Rp. <?php echo number_format($r['jumlah'], 2, ',', '.') ?></td>
            </tr>
            <tr>
                <th>status</th>
                <td><?php
            if ($r['aktif']) {
                echo 'Aktif';
            } else {
                echo 'Non-aktif';
            }
            ?>
                </td>
            </tr>
            <tr>
                <th>pemesan</th>
                <td><?php echo $r['nama_pemesan'] . " (" . $r['email'] . ")"; ?></td>
            </tr>
            </tr>
        </table>
        <table>
            <tr>
                <th>no</th>
                <th>Tanggal Transfer</th>
                <th>Bank Tujuan</th>
                <th>Kode Transfer</th>
                <th>Type</th>
                <th>Jumlah</th>
                <th width="40px"></th>
            </tr>
            <?php
                $pembayaran = mysql_query("SELECT pembayaran.*,
                                                bank.nama 
                                           FROM pembayaran
                                                LEFT JOIN bank
                                                    ON bank.id = pembayaran.bank_id
                                           WHERE pembayaran.pemesanan_id = $_GET[id]");
                $no = 0;
                while($r_pembayaran = mysql_fetch_array($pembayaran)){
                    $no++;
                    echo "<tr>
                        <td>$no</td>
                        <td>".tgl_indo($r_pembayaran[tanggal])."</td>
                        <td>$r_pembayaran[nama]</td>
                        <td>$r_pembayaran[kode_transfer]</td>
                        <td>$r_pembayaran[type]</td>
                        <td align='right'>Rp. ".number_format($r_pembayaran[jumlah],2,',','.')."</td>
                        <td>";
                    if($r_pembayaran[konfirmasi]){
                        echo '<a href="action/pdf_detailpembayaran.php?id='.$r_pembayaran[id].'" target="_blank">Print</a>';
                    }
                    echo "</td>
                    </tr>";
                }
            ?>
        </table>
        <?php if(($r['harga'] > $r['jumlah'] && $r['aktif'])){ ?>
        <a href="?pages=konfirmasi&id=<?php echo $_GET[id] ?>" class="button-h2">Bayar</a>
        <?php } ?>
        <a href="?pages=transaksi" class="button-h2 cancel">Kembali</a>
        <div style="clear: both"></div>
    </div>
</div>
