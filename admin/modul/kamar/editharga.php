<?php
$r = mysql_fetch_array(mysql_query('SELECT * FROM harga_kamar WHERE id = '.$_GET[id]));
?>
<script type="text/javascript">
    function validasi(form_data){
        if (form_data.harga.value == ""){
            alert("Anda belum mengisikan Harga.");
            form_data.harga.focus();
            return (false);
        }
   
        return (true);
    }
</script>
<h2>Tambah Harga Kamar</h2>
<form method='post' action="modul/kamar/aksi.php?act=update_harga" onSubmit="return validasi(this)" id="form_data"/>
<input type="hidden" name="id" value="<?php echo $r['id'] ?>"/>
<input type="hidden" name="kamar_id" value="<?php echo $r['kamar_id'] ?>"/>
<table>
    <tr>
        <td>Periode</td>
        <td> : 
            <select name="periode_id">
                <?php
                $q_periode = mysql_query('SELECT * FROM periode');
                while ($r_periode = mysql_fetch_array($q_periode)) {
                    if ($r_periode['id'] == $r['periode_id']) {
                        echo '<option value="' . $r_periode['id'] . '" selected="selected">' . $r_periode['nama'] . '</option>';
                    } else {
                        echo '<option value="' . $r_periode['id'] . '">' . $r_periode['nama'] . '</option>';
                    }
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Jumlah Orang</td>
        <td> : 
            <select name="jumlah_orang">
                <?php
                for ($i = 1; $i < 4; $i++) {
                    if ($i == $r['jumlah_orang']) {
                        echo '<option value="' . $i . '" selected="selected">' . $i . '</option>';
                    }else{
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                }
                ?>
            </select> Orang
        </td>
    </tr>
    <tr>
        <td>Harga Kamar</td>
        <td> : Rp. <input type="text" name="harga" value="<?php echo $r['harga'] ?>"/></td>
    </tr>
    <tr>
        <td>Jenis Sewa</td>
        <td> : 
            <select name="type">
                <option value="bulan" <?php if($r['type'] == 'bulan') echo 'selected="selected"'; ?> >Bulan</option>
                <option value="6 bulan" <?php if($r['type'] == '6 bulan') echo 'selected="selected"'; ?> >6 Bulan</option>
                <option value="tahun" <?php if($r['type'] == 'tahun') echo 'selected="selected"'; ?> >Tahun</option>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan=2>
            <input type=submit name=submit class='tombol' value=Simpan>
            <input type=button class='tombol' value=Batal onclick=self.history.back()>
        </td>
    </tr>
</table>
</form>