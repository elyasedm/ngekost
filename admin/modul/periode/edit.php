<?php
$edit = mysql_query("SELECT * FROM periode WHERE id='$_GET[id]'");
$r = mysql_fetch_array($edit);
?>
<script type="text/javascript" src="modul/<?php echo substr($_GET[page], 5); ?>/validasi.js"></script>
<h2>Edit Periode</h2>
<form method='post' action="modul/<?php echo substr($_GET[page], 5); ?>/aksi.php?act=edit" onSubmit="return validasi(this)" id="form_data">
    <input type="hidden" readonly="readonly" name="id" value="<?php echo $r[id] ?>"/>
    <table>
        <tr>
            <td>Nama Periode</td>
            <td> : <input type=text name='nama' size='40' value="<?php echo $r[nama] ?>"></td>
        </tr>
        <tr>
            <td colspan=2>
                <input type=submit name=submit class='tombol' value=Simpan>
                <input type=button class='tombol' value=Batal onclick="window.location = 'media.php?page=periode' "/>
            </td>
        </tr>
    </table>
</form>