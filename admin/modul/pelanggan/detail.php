<?php
$edit = mysql_query("SELECT * FROM pelanggan WHERE id='$_GET[id]'");
$r = mysql_fetch_array($edit);
?>
<h2>Detail Pelanggan</h2>
<table>
    <tr valingn="middle">
        <td>User ID</td>
        <td> : <?php echo $r['id'] ?></td>
        <td rowspan="8" align="center"><img src="../photos/<?php echo $r['photo'] ?>" style="width: 200px;border: 2px solid #000;"/></td>
    </tr>
    <tr>
        <td>No. KTP</td>
        <td> : <?php echo $r['ktp'] ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td> : <?php echo $r['email'] ?></td>
    </tr>
    <tr>
        <td>Nama pelanggan</td>
        <td> : <?php echo $r['nama'] ?></td>
    </tr>
    <tr>
        <td>No. Handphone</td>
        <td> : <?php echo $r['no_hp'] ?></td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td> :
            <?php if ($r['jenis_kelamin'] == 'L') { ?>
                Laki-laki 
            <?php } else { ?>
                Perempuan
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td> : <?php echo $r['alamat'] ?></td>
    </tr>
    <tr>
        <td>Kampus</td>
        <td> : <?php echo $r['kampus'] ?></td>
    </tr>
    <tr>
        <td colspan=3>
            <input type=button class='tombol' value=Kembali onclick="window.location = 'media.php?page=pelanggan' "/>
        </td>
    </tr>
</table>