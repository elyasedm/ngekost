<div class="contact">
    <h1>Daftar Transaksi <?php echo $_SESSION['member']['nama'] ?></h1>
    <div class="content-table">
        <table>
            <tr>
                <th>no</th>
                <th>id pemesanan</th>
                <th>tanggal pemesanan</th>
                <th>kamar (kosan)</th>
                <th>harga</th>
                <th>sudah dibayar</th>
                <th>status</th>
                <th>pemesan</th>
                <th width="120px"></th>
            </tr>
            <?php
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
            WHERE pemesanan.pelanggan_id = ".$_SESSION[member][id]."
            GROUP BY pemesanan.id
                ");
            $no = 0;
            while ($r = mysql_fetch_array($transaksi)) {
                $no++;
                echo "<tr>
                        <td>$no</td>
                        <td>$r[id]</td>
                        <td>$r[tanggal]</td>
                        <td><a href='?pages=detail_kamar&id=$r[id_kamar]'>$r[nama_kamar]</a> (<a href='?pages=detail_kost&id=$r[id_kost]'>$r[nama_kost]</a>)</td>
                        <td align='right'>Rp. " . number_format($r['harga'], 2, ',', '.') . " / $r[type]</td>
                        <td align='right'>Rp. " . number_format($r['jumlah'], 2, ',', '.') . "</td>
                        <td>";
                if ($r['aktif']) {
                    echo 'Aktif';
                } else {
                    echo 'Non-aktif';
                }
                echo "</td>
                        <td>$r[nama_pemesan] ($r[email])</td>
                        <td align='center'>";
                if(($r['harga'] > $r['jumlah'] && $r['aktif'])){
                    echo "<a href='?pages=konfirmasi&id=$r[id]'>Bayar</a> | ";
                }
                echo "<a href='?pages=detail_transaksi&id=$r[id]'>Detail</a>";
                if ($r['aktif']) {
                    echo " | <a href='action/batal.php?id=$r[id]' onclick='return confirm(\"Pemesanan kamar dibatalkan, kamar dapat dipesan kembali dan pembayaran yang telah anda tidak dapat dikembalikan?\")'>Batal</a></td>";
                }
                echo "<tr>";
            }
            ?>
        </table>
    </div>
</div>
