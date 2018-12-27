<script type="text/javascript" src="modul/<?php echo substr($_GET[page], 4); ?>/validasi.js"></script>
<h2>Tambah Bank</h2>
<form method='post' action="modul/<?php echo substr($_GET[page], 4); ?>/aksi.php?act=input" onSubmit="return validasi(this)" id="form_data">
    <table>
        <tr>
            <td>Nama Bank</td>
            <td> : <input type=text name='nama' size='40' onkeypress="return isAlfabetAndNumberKey(event)"></td>
        </tr>
        <tr>
            <td>No. Rekening</td>
            <td> : <input type=text name='no_rekening' size='40' onkeypress="return isNumberKey(event)"></td>
        </tr>
        <tr>
            <td>Nama Nasabah</td>
            <td> : <input type=text name='nama_nasabah' size='40' onkeypress="return isAlfabetKeyAndSpace(event)"></td>
        </tr>
        <tr>
            <td>Status</td>
            <td> : 
                <input type="radio" name="aktif" value="1" checked="checked"/>Aktif 
                <input type="radio" name="aktif" value="0"/>Non-Aktif
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