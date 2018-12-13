<div class="contact">
    <?php
    $user = mysql_query('SELECT * FROM pelanggan WHERE id = "' . $_SESSION['member']['id'] . '"');
    $r = mysql_fetch_array($user);
    ?>
    <h1>Profile User</h1>
    <div class="content-table">
        <table>
            <tr>
                <th width="200px">Nama</th>
                <td><?php echo $r[nama] ?></td>
                <td rowspan="7" width="235px">
                    <img src="
                    <?php
                    if (empty($r[photo])) {
                        echo "photos/na.jpg";
                    } else {
                        echo 'photos/small_' . $r[photo];
                    }
                    ?>
                         " style="width: 215px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius: 10px;border:2px solid #000;"/>
                </td>
            </tr>
            <tr>
                <th>No. KTP</th>
                <td><?php echo $r[ktp] ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $r[email] ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td><?php echo $r[alamat] ?></td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>
                    <?php
                    if ($r[jenis_kelamin] == 'L') {
                        echo 'Laki - Laki';
                    }  else {
                        echo 'Perempuan';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>No. Handphone</th>
                <td><?php echo $r[no_hp] ?></td>
            </tr>
            <tr>
                <th>Kampus</th>
                <td><?php echo $r[kampus] ?></td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <th align="center" colspan="2"><input type="button" onclick="location.href = 'index.php?pages=edit_profile'" value="Edit Profile"/></th>
            </tr>
        </table>
    </div>
</div>
