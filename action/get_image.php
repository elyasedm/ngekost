<?php

require_once '../config/koneksi.php';
$data = array();
$kost = mysql_fetch_array(mysql_query('SELECT kost_id FROM tempat WHERE id=' . $_GET[id]));
if (!empty($kost) && $kost['kost_id'] != 0) {
    $query = mysql_query('SELECT * FROM gambar_kost WHERE kost_id=' . $kost[kost_id] . ' ORDER BY type ASC');
    
    $fasilitas_kost = '<ul>';
    $fasilitas = mysql_query('SELECT fasilitas.* FROM fasilitas_kost LEFT JOIN fasilitas ON fasilitas.id = fasilitas_kost.fasilitas_id WHERE fasilitas_kost.kost_id=' . $kost[kost_id]);
    while ($r_fasilitas = mysql_fetch_array($fasilitas)) {
        $fasilitas_kost .= '<li><b>' . $r_fasilitas[nama] . '</b><br/>';
        $fasilitas_kost .= $r_fasilitas[keterangan] . '</li>';
    }
    $fasilitas_kost .= '</ul>';

    $detail = mysql_fetch_array(mysql_query('SELECT kost.*,
                                    pemilik.nama AS nama_pemilik,
                                    pemilik.email,
                                    pemilik.no_hp
                                FROM kost 
                                    LEFT JOIN pemilik
                                        ON pemilik.id = kost.pemilik_id
                                WHERE kost.id=' . $kost[kost_id]));
    $data[detail] = '<table cellspacing="0" cellpadding="5px">
        <tr>
            <th>Nama Pemilik</th>
            <td>: ' . $detail[nama_pemilik] . '</td>
        </tr>
        <tr>
            <th>No. Handphone</th>
            <td>: ' . $detail[no_hp] . '</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>: ' . $detail[email] . '</td>
        </tr>
        <tr>
            <th>Nama Kosan</th>
            <td>: ' . $detail[nama] . '</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>: ' . $detail[alamat] . '</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>: ' . $detail[keterangan] . '</td>
        </tr>
        <tr>
            <th>Fasilitas</th>
            <td>: ' . $fasilitas_kost . '</td>
        </tr>
        </table>';
} else {
    $query = mysql_query('SELECT * FROM gambar_tempat WHERE tempat_id=' . $_GET[id] . ' ORDER BY type ASC');
    $detail = mysql_fetch_array(mysql_query('SELECT * FROM tempat WHERE id='. $_GET[id]));
    $data[detail] = '<table cellspacing="0" cellpadding="5px">
        <tr>
            <th>Nama Tempat</th>
            <td>: ' . $detail[nama] . '</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>: ' . $detail[alamat] . '</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>: ' . $detail[keterangan] . '</td>
        </tr>
        </table>';
}
while ($r = mysql_fetch_array($query)) {
    $data['image'][] = array(
        'id' => $r[id],
        'lokasi' => $r[lokasi],
        'keterangan' => $r[keterangan],
    );
}

echo json_encode($data);
die;
?>