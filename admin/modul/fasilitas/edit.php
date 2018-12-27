<?php
$edit = mysql_query("SELECT * FROM fasilitas WHERE id='$_GET[id]'");
$r = mysql_fetch_array($edit);
?>
<script type="text/javascript" src="modul/<?php echo substr($_GET[page], 5); ?>/validasi.js"></script>
<h2>Edit Fasilitas</h2>
<form method='post' action="modul/<?php echo substr($_GET[page], 5); ?>/aksi.php?act=edit" onSubmit="return validasi(this)" id="form_data">
    <input type="hidden" readonly="readonly" name="id" value="<?php echo $r[id] ?>"/>
    <table>
        <tr>
            <td>Nama Fasilitas</td>
            <td> : <input type=text name='nama' size='40' value="<?php echo $r[nama] ?>" onkeypress="return isAlfabetKeyAndSpace(event)"></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td> : <textarea name="keterangan" cols="53" rows="5"><?php echo $r[no_rekening] ?></textarea></td>
        </tr>
        <tr>
            <td colspan=2>
                <input type=submit name=submit class='tombol' value=Simpan>
                <input type=button class='tombol' value=Batal onclick="window.location = 'media.php?page=fasilitas' "/>
            </td>
        </tr>
    </table>
</form>