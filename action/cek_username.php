<?php
    require_once '../config/koneksi.php';
    if($_GET['table'] != 'pelanggan'){
        $user = mysql_fetch_array(mysql_query('SELECT COUNT(*) AS count FROM '.$_GET['table'].' WHERE id = "'.$_GET['id'].'"'));
    }else{
        $user = mysql_fetch_array(mysql_query('SELECT COUNT(*) AS count FROM '.$_GET['table'].' WHERE email = "'.$_GET['id'].'"'));
    }
    echo $user['count'];
    die;
?>
