<?php
$edit = mysql_query("SELECT * FROM bank WHERE id='$_GET[id]'");
$r = mysql_fetch_array($edit);
?>
<script type="text/javascript" src="modul/<?php echo substr($_GET[page], 5); ?>/validasi.js"></script>
<h2>Edit Bank</h2>
<form method='post' action="modul/<?php echo substr($_GET[page], 5); ?>/aksi.php?act=edit" onSubmit="return validasi(this)" id="form_data">
    <input type="hidden" readonly="readonly" name="id" value="<?php echo $r[id] ?>"/>
    <table>
        <tr>
            <td>Nama Bank</td>
            <td> : <input type=text name='nama' size='40' value="<?php echo $r[nama] ?>" onkeypress="return isAlfabetAndNumberKey(event)"></td>
        </tr>
        <tr>
            <td>No. Rekening</td>
            <td> : <input type=text name='no_rekening'  value="<?php echo $r[no_rekening] ?>" size='40' onkeypress="return isNumberKey(event)"></td>
        </tr>
        <tr>
            <td>Nama Nasabah</td>
            <td> : <input type=text name='nama_nasabah' size='40'  value="<?php echo $r[nama_nasabah] ?>" onkeypress="return isAlfabetKeyAndSpace(event)"></td>
        </tr>
        <tr>
            <td>Status</td>
            <td> : 
                <?php if ($r['aktif']) { ?>
                    <input type="radio" name="aktif" value="1" checked="checked"/>Aktif 
                    <input type="radio" name="aktif" value="0"/>Non-Aktif
                <?php } else { ?>
                    <input type="radio" name="aktif" value="1"/>Aktif 
                    <input type="radio" name="aktif" value="0" checked="checked"/>Non-Aktif
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td colspan=2>
                <input type=submit name=submit class='tombol' value=Simpan>
            <input type=button class='tombol' value=Batal onclick="window.location = 'media.php?page=bank' "/>
            </td>
        </tr>
    </table>
</form>