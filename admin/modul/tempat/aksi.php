<?php

session_start();
include "../../../config/koneksi.php";
include "../../../config/upload.php";

if ($_GET['act'] == 'delete') {
    mysql_query("DELETE FROM tempat WHERE id = '$_GET[id]'");
    header("Location:../../media.php?page=tempat&p=" . $_SESSION['admin']['pagination']['tempat']);
} elseif ($_GET['act'] == 'input') {
    mysql_query("INSERT INTO tempat(nama,keterangan,alamat,bujur,lintang,type_tempat_id,kost_id)
        VALUES('$_GET[nama]','$_GET[keterangan]','$_GET[alamat]','$_GET[bujur]','$_GET[lintang]','$_GET[type_tempat_id]','$_GET[kost_id]')");
    die;
} elseif ($_GET['act'] == 'update') {
    mysql_query('UPDATE tempat 
        SET nama = "' . $_GET[nama] . '",
            bujur = "' . $_GET[bujur] . '",
            lintang = "' . $_GET[lintang] . '",
            type_tempat_id = "' . $_GET[type_tempat_id] . '",
            kost_id = "' . $_GET[kost_id] . '",
            keterangan = "' . $_GET[keterangan] . '",
            alamat = "' . $_GET[alamat] . '"
        WHERE id = ' . $_GET[id]);
    die;
} elseif ($_GET[act] == 'input_img') {
    $lokasi_file = $_FILES['image']['tmp_name'];
    $tipe_file = $_FILES['image']['type'];
    $nama_file = $_FILES['image']['name'];

    $nama_file = uploadImageResize($nama_file);

    if ($_POST[type] == 'cover') {
        mysql_query('UPDATE gambar_tempat SET type="gallery" WHERE tempat_id =' . $_POST[tempat_id]);
    }
    mysql_query("INSERT INTO gambar_tempat(tempat_id,
                                        lokasi,
                                        keterangan,
                                        type,
                                        aktif)
                                    VALUE('$_POST[tempat_id]',
                                        '$nama_file',
                                        '$_POST[keterangan]',
                                        '$_POST[type]',
                                        '$_POST[aktif]')");
    header("Location:../../media.php?page=photoview_tempat&id=$_POST[tempat_id]&p=" . $_SESSION['admin']['pagination']['photoview_tempat']);
} elseif ($_GET[act] == 'edit_img') {
    if ($_POST[type] == 'cover') {
        mysql_query('UPDATE gambar_tempat SET type="gallery" WHERE tempat_id =' . $_POST[tempat_id]);
    }
    if (!empty($_FILES['image']['name'])) {
        $data = mysql_fetch_array(mysql_query('SELECT lokasi FROM gambar_tempat WHERE id=' . $_POST[id]));
        unlink('../../../images/' . $data['lokasi']);
        unlink('../../../images/small_' . $data['lokasi']);
        unlink('../../../images/medium_' . $data['lokasi']);

        $lokasi_file = $_FILES['image']['tmp_name'];
        $tipe_file = $_FILES['image']['type'];
        $nama_file = $_FILES['image']['name'];
        $nama_file = uploadImageResize($nama_file);

        mysql_query("UPDATE gambar_tempat SET tempat_id = '$_POST[tempat_id]',
                                          lokasi = '$nama_file',
                                          keterangan = '$_POST[keterangan]',
                                          type = '$_POST[type]',
                                          aktif = '$_POST[aktif]'
                                      WHERE id = " . $_POST[id]);
    } else {
        mysql_query("UPDATE gambar_tempat SET tempat_id = '$_POST[tempat_id]',
                                          keterangan = '$_POST[keterangan]',
                                          type = '$_POST[type]',
                                          aktif = '$_POST[aktif]'
                                      WHERE id = " . $_POST[id]);
    }

    header("Location:../../media.php?page=photoview_tempat&id=$_POST[tempat_id]&p=" . $_SESSION['admin']['pagination']['photoview_tempat']);
} elseif ($_GET[act] == 'delete_img') {
    $data = mysql_fetch_array(mysql_query('SELECT lokasi FROM gambar_tempat WHERE id=' . $_GET[id]));
    unlink('../../../images/' . $data['lokasi']);
    unlink('../../../images/small_' . $data['lokasi']);
    unlink('../../../images/medium_' . $data['lokasi']);

    mysql_query("DELETE FROM gambar_tempat WHERE id = '$_GET[id]'");
    header("Location:../../media.php?page=photoview_tempat&id=$_GET[tempat_id]&p=" . $_SESSION['admin']['pagination']['photoview_tempat']);
}
?>
