<?php
session_start();
error_reporting(0);
ob_start("ob_gzhandler");
if (isset($_SESSION['member'])) {
    $aktif = true;
} else {
    $aktif = false;
}
require_once 'config/koneksi.php';
require_once 'config/fungsi_indotgl.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <title>NgeKost</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
        <!--[if IE 6]>
                <link rel="stylesheet" type="text/css" href="css/ie6.css" media="all" />
        <![endif]-->
        <!--[if IE 7]>
                <link rel="stylesheet" type="text/css" href="css/ie7.css" media="all" />
        <![endif]-->
        <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
        <script type="text/javascript" src="js/validate.js"></script>
        <script type="text/javascript">
            $(function(){
                // Datepicker
                $('#datepicker').datepicker({
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    showButtonPanel: true,
                    changeMonth: true,
                    changeYear: true,
                    minDate: new Date(),
                    maxDate: '+14d',
                    inline: true                
                });
                
                $(".tabs").tabs();
            });
        </script>
        <?php
        if ($_GET['pages'] == 'maps') {
            require_once 'js/maps.php';
        }
        ?>
    </head>
    <body <?php
        if ($_GET['pages'] == 'maps') {
            echo 'onload="initMap()"';
        }
        ?>>
        <div id="header">
            <ul>
                <li <?php if ($_GET['pages'] == 'home' || empty($_GET['pages'])) echo 'class="selected"' ?>><a href="?pages=home">Home</a></li>
                <li <?php if ($_GET['pages'] == 'kost') echo 'class="selected"' ?>><a href="?pages=kost">Daftar Kosan</a></li>
<!--                <li <?php if ($_GET['pages'] == 'kamar') echo 'class="selected"' ?>><a href="?pages=kamar">Daftar Kamar</a></li> -->
          <!--    <li <?php if ($_GET['pages'] == 'maps') echo 'class="selected"' ?>><a href="?pages=maps">Peta Lokasi</a></li>-->
                <?php
                if ($aktif) {
                    $read = mysql_fetch_array(mysql_query('
                        SELECT COUNT(pembayaran.id) AS count
                        FROM pembayaran 
                            LEFT JOIN pemesanan
                                ON pemesanan.id = pembayaran.pemesanan_id
                        WHERE pembayaran.konfirmasi = 1
                            AND pembayaran.read = 0
                            AND pemesanan.pelanggan_id=' . $_SESSION['member']['id']))
                    ?>
                    <li <?php if ($_GET['pages'] == 'transaksi') echo 'class="selected"' ?>><a href="?pages=transaksi">Daftar Transaksi<?php if ($read['count'] > 0) echo '<i style="color:red;"> (' . $read['count'] . ')</i>' ?></a></li>		
<?php } ?>
      <!--      <li <?php if ($_GET['pages'] == 'payment') echo 'class="selected"' ?>><a href="?pages=payment">Cara Pembayaran</a></li> -->
                <li <?php if ($_GET['pages'] == 'about') echo 'class="selected"' ?>><a href="?pages=about">Tentang Kami</a></li>
<!--                <li <?php if ($_GET['pages'] == 'contact') echo 'class="selected"' ?>><a href="?pages=contact">Kontak Kami</a></li> -->
<?php if ($aktif) { ?>
                    <li <?php if ($_GET['pages'] == 'profile') echo 'class="selected"' ?>><a href="?pages=profile">Profil User</a></li>		
                    <li><a href="action/logout.php">Logout</a></li>		
                <?php } else { ?>
                    <li><a href="?pages=login">Login</a></li>		
<?php } ?>
            </ul>
            <div class="logo">
                <a href="index.php"><img src="images/Ngekost Logo.png" alt="" /></a>
            </div>
        </div>
        <div id="body">
            <?php
            if (!empty($_GET['pages'])) {
                require_once 'pages/' . $_GET['pages'] . '.php';
            } else {
                require_once 'pages/home.php';
            }
            ?>
        </div>
        <div id="footer">
            <div>
                <p>By : Elyas Dwi Maryanto</p>
            </div>
        </div>
    </body>
</html>