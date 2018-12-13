<div class="contact">
    <h1>Daftar Transaksi <?php echo $_SESSION['member']['nama'] ?></h1>
    <div class="content-table">
        <table style="width: 400px">
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
                <th>sudah dibayar</th>
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
        <form method="post" action="action/konfirmasi.php">
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" readonly="readonly"/>
            <table style="width: 600px">
                <tr>
                    <th width="150px">Bank Tujuan</t>
                    <td>
                        <select name="bank">
                            <?php
                            $bank = mysql_query('SELECT * FROM bank WHERE aktif = 1');
                            while ($r_bank = mysql_fetch_array($bank)) {
                                echo "<option value='$r_bank[id]'>$r_bank[nama] ($r_bank[no_rekening])</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Tranfer</th>
                    <td><input type="text" id="datepicker" name="tanggal" readonly="readonly" size="6"/></td>
                </tr>
                <tr>
                    <th>Kode Transfer</th>
                    <td><input type="text" name="kode" size="40"/></td>
                </tr>
                <tr>
                    <th>Jumlah Transfer</th>
                    <td>Rp. <input type="text" name="jumlah"/></td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td><input type="submit" value="Konfirmasi"/></td>
                </tr>
            </table>
        </form>
    </div>
<a href="?pages=transaksi" class="button-h2 cancel">Kembali</a>
</div>

