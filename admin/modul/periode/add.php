<script type="text/javascript" src="modul/<?php echo substr($_GET[page], 4); ?>/validasi.js"></script>
<h2>Tambah Periode</h2>
<form method='post' action="modul/<?php echo substr($_GET[page], 4); ?>/aksi.php?act=input" onSubmit="return validasi(this)" id="form_data">
    <table>
        <tr>
            <td>Nama Periode</td>
            <td> : <input type=text name='nama' size='40'></td>
        </tr>
        <tr>
            <td colspan=2>
                <input type=submit name=submit class='tombol' value=Simpan>
            <input type=button class='tombol' value=Batal onclick="window.location = 'media.php?page=periode' "/>
            </td>
        </tr>
    </table>
</form>