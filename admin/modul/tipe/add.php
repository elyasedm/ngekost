<script type="text/javascript" src="modul/<?php echo substr($_GET[page], 4); ?>/validasi.js"></script>
<h2>Tambah Jenis Tempat</h2>
<form method='post' action="modul/<?php echo substr($_GET[page], 4); ?>/aksi.php?act=input" enctype="multipart/form-data" onSubmit="return validasi(this)" id="form_data">
    <table>
        <tr>
            <td>Nama Jenis Tempat</td>
            <td> : <input type=text name='nama' size='40' onkeypress="return isAlfabetKeyAndSpace(event)"></td>
        </tr>
        <tr>
            <td>Icon Jenis Tempat</td>
            <td> : <input type=file name='file' size='40'></td>
        </tr>
        <tr>
            <td colspan=2>
                <input type=submit name=submit class='tombol' value=Simpan>
                <input type=button class='tombol' value=Kembali onclick="window.location = 'media.php?page=tipe' "/>
            </td>
        </tr>
    </table>
</form>