<?php

include "../../../config/koneksi.php";
include "../../../config/upload.php";

// Input menu utama
if ($_GET[act] == 'input') {

    $test = mysql_query("INSERT INTO kost(nama,
                                    alamat,
                                    pemilik_id,
                                    keterangan,
                                    aktif) 
                                VALUES('$_POST[nama]',
                                    '$_POST[alamat]',
                                    '$_POST[pemilik_id]',
                                    '$_POST[keterangan]',
                                    '$_POST[aktif]')
    ");
    if ($test && isset($_POST['fasilitas'])) {
        $data = mysql_fetch_array(mysql_query('SELECT id FROM kost ORDER BY id DESC LIMIT 1'));
        foreach ($_POST['fasilitas'] as $fasilitas) {
            mysql_query('INSERT INTO fasilitas_kost(kost_id,fasilitas_id) VALUES(' . $data['id'] . ',' . $fasilitas . ')');
        }
    }
    header("Location:../../media.php?page=kost&p=" . $_SESSION['admin']['pagination']['kost']);
}

// Update menu utama
elseif ($_GET[act] == 'update') {
    mysql_query("UPDATE kost SET nama='$_POST[nama]',
               alamat = '$_POST[alamat]',
               pemilik_id = '$_POST[pemilik_id]',
               aktif = '$_POST[aktif]',
               keterangan = '$_POST[keterangan]'
               WHERE id = '$_POST[id]'");

    $delete = mysql_query('DELETE FROM fasilitas_kost WHERE kost_id=' . $_POST[id]);
    if ($delete && isset($_POST['fasilitas'])) {
        foreach ($_POST['fasilitas'] as $fasilitas) {
            mysql_query('INSERT INTO fasilitas_kost(kost_id,fasilitas_id) VALUES(' . $_POST[id] . ',' . $fasilitas . ')');
        }
    }
    header("Location:../../media.php?page=kost&p=" . $_SESSION['admin']['pagination']['kost']);
}

// Update menu utama
elseif ($_GET[act] == 'delete') {
    mysql_query("DELETE FROM kost WHERE id = '$_GET[id]'");
    header("Location:../../media.php?page=kost&p=" . $_SESSION['admin']['pagination']['kost']);
} elseif ($_GET[act] == 'input_img') {

    $lokasi_file = $_FILES['image']['tmp_name'];
    $tipe_file = $_FILES['image']['type'];
    $nama_file = $_FILES['image']['name'];

    $nama_file = uploadImageResize($nama_file);

    if ($_POST[type] == 'cover') {
        mysql_query('UPDATE gambar_kost SET type="gallery" WHERE kost_id =' . $_POST[kost_id]);
    }
    mysql_query("INSERT INTO gambar_kost(kost_id,
                                        lokasi,
                                        keterangan,
                                        type,
                                        aktif)
                                    VALUE('$_POST[kost_id]',
                                        '$nama_file',
                                        '$_POST[keterangan]',
                                        '$_POST[type]',
                                        '$_POST[aktif]')");
    header("Location:../../media.php?page=photoview_kost&id=$_POST[kost_id]&p=" . $_SESSION['admin']['pagination']['photoview_kost']);
} elseif ($_GET[act] == 'edit_img') {
    if ($_POST[type] == 'cover') {
        mysql_query('UPDATE gambar_kost SET type="gallery" WHERE kost_id =' . $_POST[kost_id]);
    }
    if (!empty($_FILES['image']['name'])) {
        $data = mysql_fetch_array(mysql_query('SELECT lokasi FROM gambar_kost WHERE id=' . $_POST[id]));
        unlink('../../../images/' . $data['lokasi']);
        unlink('../../../images/small_' . $data['lokasi']);
        unlink('../../../images/medium_' . $data['lokasi']);

        $lokasi_file = $_FILES['image']['tmp_name'];
        $tipe_file = $_FILES['image']['type'];
        $nama_file = $_FILES['image']['name'];
        $nama_file = uploadImageResize($nama_file);

        mysql_query("UPDATE gambar_kost SET kost_id = '$_POST[kost_id]',
                                          lokasi = '$nama_file',
                                          keterangan = '$_POST[keterangan]',
                                          type = '$_POST[type]',
                                          aktif = '$_POST[aktif]'
                                      WHERE id = " . $_POST[id]);
    } else {
        mysql_query("UPDATE gambar_kost SET kost_id = '$_POST[kost_id]',
                                          keterangan = '$_POST[keterangan]',
                                          type = '$_POST[type]',
                                          aktif = '$_POST[aktif]'
                                      WHERE id = " . $_POST[id]);
    }

    header("Location:../../media.php?page=photoview_kost&id=$_POST[kost_id]&p=" . $_SESSION['admin']['pagination']['photoview_kost']);
} elseif ($_GET[act] == 'delete_img') {
    $data = mysql_fetch_array(mysql_query('SELECT lokasi FROM gambar_kost WHERE id=' . $_GET[id]));
    unlink('../../../images/' . $data['lokasi']);
    unlink('../../../images/small_' . $data['lokasi']);
    unlink('../../../images/medium_' . $data['lokasi']);

    mysql_query("DELETE FROM gambar_kost WHERE id = '$_GET[id]'");
    header("Location:../../media.php?page=photoview_kost&id=$_GET[kost_id]&p=" . $_SESSION['admin']['pagination']['photoview_kost']);
} elseif ($_GET[act] == 'n_aktif') {
    mysql_query("UPDATE kost SET aktif = 0 WHERE id = '$_GET[id]'");
    header("Location:../../media.php?page=kost&p=" . $_SESSION['admin']['pagination']['kost']);
} elseif ($_GET[act] == 'aktif') {
    mysql_query("UPDATE kost SET aktif = 1 WHERE id = '$_GET[id]'");
    header("Location:../../media.php?page=kost&p=" . $_SESSION['admin']['pagination']['kost']);
}
?>
