<?php

include "../../../config/koneksi.php";
include "../../../config/upload.php";

// Input menu utama
if ($_GET[act] == 'input') {
    $test = mysql_query("INSERT INTO kamar(nama,
                                    jenis,
                                    kost_id,
                                    keterangan) 
                                VALUES('$_POST[nama]',
                                    '$_POST[jenis]',
                                    '$_POST[kost_id]',
                                    '$_POST[keterangan]')
    ");
    header("Location:../../media.php?page=kamar&id=$_POST[kost_id]&p=" . $_SESSION['admin']['pagination']['kamar']);
}

// Update menu utama
elseif ($_GET[act] == 'update') {
    mysql_query("UPDATE kamar SET nama='$_POST[nama]',
               jenis = '$_POST[jenis]',
               keterangan = '$_POST[keterangan]'
               WHERE id = '$_POST[id]'");
    header("Location:../../media.php?page=kamar&id=$_POST[kost_id]&p=" . $_SESSION['admin']['pagination']['kamar']);
}

// Update menu utama
elseif ($_GET[act] == 'delete') {
    mysql_query("DELETE FROM kamar WHERE id = '$_GET[id]'");
    header("Location:../../media.php?page=kamar&id=$_GET[kost_id]&p=" . $_SESSION['admin']['pagination']['kamar']);
} elseif ($_GET[act] == 'input_img') {
    $lokasi_file = $_FILES['image']['tmp_name'];
    $tipe_file = $_FILES['image']['type'];
    $nama_file = $_FILES['image']['name'];

    $nama_file = uploadImageResize($nama_file);

    if ($_POST[type] == 'cover') {
        mysql_query('UPDATE gambar_kamar SET type="gallery" WHERE kamar_id =' . $_POST[kamar_id]);
    }
    mysql_query("INSERT INTO gambar_kamar(kamar_id,
                                        lokasi,
                                        keterangan,
                                        type,
                                        aktif)
                                    VALUE('$_POST[kamar_id]',
                                        '$nama_file',
                                        '$_POST[keterangan]',
                                        '$_POST[type]',
                                        '$_POST[aktif]')");
    header("Location:../../media.php?page=photoview_kamar&id=$_POST[kamar_id]&p=" . $_SESSION['admin']['pagination']['photoview_kamar']);
} elseif ($_GET[act] == 'edit_img') {
    if ($_POST[type] == 'cover') {
        mysql_query('UPDATE gambar_kamar SET type="gallery" WHERE kamar_id =' . $_POST[kamar_id]);
    }
    
    if (!empty($_FILES['image']['name'])) {
        $data = mysql_fetch_array(mysql_query('SELECT lokasi FROM gambar_kamar WHERE id=' . $_POST[id]));
        unlink('../../../images/' . $data['lokasi']);
        unlink('../../../images/small_' . $data['lokasi']);
        unlink('../../../images/medium_' . $data['lokasi']);

        $lokasi_file = $_FILES['image']['tmp_name'];
        $tipe_file = $_FILES['image']['type'];
        $nama_file = $_FILES['image']['name'];
        $nama_file = uploadImageResize($nama_file);

        mysql_query("UPDATE gambar_kamar SET kamar_id = '$_POST[kamar_id]',
                                          lokasi = '$nama_file',
                                          keterangan = '$_POST[keterangan]',
                                          type = '$_POST[type]',
                                          aktif = '$_POST[aktif]'
                                      WHERE id = " . $_POST[id]);
    } else {
        mysql_query("UPDATE gambar_kamar SET kamar_id = '$_POST[kamar_id]',
                                          keterangan = '$_POST[keterangan]',
                                          type = '$_POST[type]',
                                          aktif = '$_POST[aktif]'
                                      WHERE id = " . $_POST[id]);
    }

    header("Location:../../media.php?page=photoview_kamar&id=$_POST[kamar_id]&p=" . $_SESSION['admin']['pagination']['photoview_kamar']);
} elseif ($_GET[act] == 'delete_img') {
    $data = mysql_fetch_array(mysql_query('SELECT lokasi FROM gambar_kamar WHERE id=' . $_GET[id]));
    unlink('../../../images/' . $data['lokasi']);
    unlink('../../../images/small_' . $data['lokasi']);
    unlink('../../../images/medium_' . $data['lokasi']);

    mysql_query("DELETE FROM gambar_kamar WHERE id = '$_GET[id]'");
    header("Location:../../media.php?page=photoview_kamar&id=$_GET[kamar_id]");
} elseif ($_GET[act] == 'input_harga') {
    $test = mysql_query("INSERT INTO harga_kamar(kamar_id,
                                    periode_id,
                                    jumlah_orang,
                                    harga,
                                    type) 
                                VALUES('$_POST[kamar_id]',
                                    '$_POST[periode_id]',
                                    '$_POST[jumlah_orang]',
                                    '$_POST[harga]',
                                    '$_POST[type]')");
    header("Location:../../media.php?page=harga_kamar&id=$_POST[kamar_id]&p=" . $_SESSION['admin']['pagination']['harga_kamar']);
} elseif ($_GET[act] == 'update_harga') {
    mysql_query("UPDATE harga_kamar SET kamar_id='$_POST[kamar_id]',
               periode_id = '$_POST[periode_id]',
               jumlah_orang = '$_POST[jumlah_orang]',
               harga = '$_POST[harga]',
               type = '$_POST[type]'
               WHERE id = '$_POST[id]'");
    header("Location:../../media.php?page=harga_kamar&id=$_POST[kamar_id]&p=" . $_SESSION['admin']['pagination']['harga_kamar']);
} elseif ($_GET[act] == 'delete_harga') {
    mysql_query("DELETE FROM harga_kamar WHERE id = '$_GET[id]'");
    header("Location:../../media.php?page=harga_kamar&id=$_GET[kamar_id]&p=" . $_SESSION['admin']['pagination']['harga_kamar']);
}
?>
