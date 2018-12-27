<style>
    li.list-img{
        float:left;
        width:50%;
        height:64px;
        list-style: none; 
        vertical-align: middle;
    }
    div.hide{
        z-index: 999;
        width: 700px;
        height: auto;
        position: absolute;
        top: 500px;
        left: 200px;
        font-size: 12px;
        display: none;
    }
</style>
<div style="clear:both;height: 30px;"></div>
<div style="margin: 10px auto;width: 100%;height: 600px; border: 2px #C30075 solid;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius: 10px; background: #C30075;box-shadow: 0 0 5px #000;">
    <div id="maps" style="float: left;width: 70%;height: 100%;border-bottom-left-radius: 10px;border-top-left-radius: 10px;-moz-border-bottom-left-radius: 10px;-moz-border-top-left-radius: 10px;-webkit-border-top-left-radius: 10px;-webkit-border-bottom-left-radius: 10px; background: #C30075;"></div>
    <div style="float: right;width: 30%;height: 100%;border-bottom-right-radius: 10px;border-top-right-radius: 10px;-moz-border-bottom-right-radius: 10px;-moz-border-top-right-radius: 10px;-webkit-border-top-right-radius: 10px;-webkit-border-bottom-right-radius: 10px; background-color: #F4F3F0;">
        <div style="border-left: 3px #C30075 solid;height: 100%">
            <h2 style="margin: 0 auto 10px auto;text-align: center;">Keterangan</h2>
            <div style="height: 90%;overflow-y: auto;">
                <ul style="margin: 10px">
                    <?php
                    $type = mysql_query('SELECT * FROM type_tempat WHERE id <> 1 ORDER BY nama');
                    $i=0;
                    while ($r = mysql_fetch_array($type)) {
                        $i++;
                        if($i == 1){
                            echo '<script type="text/javascript">setIcon("'.$r[id].'","'.$r[gambar].'")</script>';
                            echo "<li class='list-img'><input type='radio' value='../maps/$r[gambar]' data-id='$r[id]' class='check-maps' name='check-maps' checked='checked'/><img src='../maps/$r[gambar]'/> $r[nama]</li>";
                        }  else {
                            echo "<li class='list-img'><input type='radio' value='../maps/$r[gambar]' data-id='$r[id]' class='check-maps' name='check-maps'/><img src='../maps/$r[gambar]'/> $r[nama]</li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div style="clear:both;height: 30px;"></div>

<h2>Tambah Tempat</h2>
<form method='post' action="modul/<?php echo substr($_GET[page], 4); ?>/aksi.php?act=input" onSubmit="return validasi(this)" id="form_data"/>
<table>
    <tr>
        <td>Lintang</td>
        <td> : <input type="text" name='email' size='40' readonly="readonly" id="lintang"/></td>
    </tr>
    <tr>
        <td>Bujur</td>
        <td> : <input type="text" name="nama" size="40" readonly="readonly" id="bujur"></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td> : <input type="text" name="nama" size="40" id="nama"></td>
    </tr>
    <tr>
        <td>Keterangan</td>
        <td> : <textarea id="ket" cols="52" rows="5"></textarea></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td> : <textarea id="alamat" cols="52" rows="5"></textarea></td>
    </tr>
    <tr>
        <td colspan=2>
            <input type=button name=button class='tombol' value="Simpan" id="simpan">
            <input type=button class='tombol' value=Batal onclick="window.location = 'media.php?page=tempat' "/>
        </td>
    </tr>
</table>
</form>