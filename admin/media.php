<?php
session_start();
ob_start("ob_gzhandler");
error_reporting(0);
if (!isset($_SESSION['admin'])) {
    ?>
    <link href='css/screen.css' rel='stylesheet' type='text/css'><link href='css/reset.css' rel='stylesheet' type='text/css'>


 <center><br><br><br><br><br><br>Maaf, untuk masuk <b>Halaman Administrator</b><br></center>
  <center>anda harus <b>Login</b> dahulu!<br><br>
    <div> <a href='index.php'><img src='images/kunci.png'  height=176 width=143></a>
             </div>
    <input type=button class=simplebtn value='LOGIN DI SINI' onclick=location.href='index.php'></a></center>
    <?php
} else {
    include "../config/koneksi.php";
    include "../config/fungsi_indotgl.php";
    include "../config/library.php";
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <title>.::Admin NgeKost::.</title>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
            <link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
            <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
            <script type="text/javascript" src="../js/jquery-ui-1.8.21.custom.min.js"></script>
            <link rel="stylesheet" href="css/reset.css" type="text/css"/>
            <link rel="stylesheet" href="css/screen.css" type="text/css"/>
            <script type="text/javascript" src="js/validate.js"></script>
            <script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
            <script type="text/javascript">
                tinyMCE.init({
                    // General options
                    mode : "exact",
                    elements : "keterangan",
                    theme : "advanced",
                    plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

                    // Theme options
                    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
                    theme_advanced_toolbar_location : "top",
                    theme_advanced_toolbar_align : "left",
                    theme_advanced_statusbar_location : "bottom",
                    theme_advanced_resizing : true,

                    // Example content CSS (should be your site CSS)
                    content_css : "css/content.css",

                    // Drop lists for link/image/media/template dialogs
                    template_external_list_url : "lists/template_list.js",
                    external_link_list_url : "lists/link_list.js",
                    external_image_list_url : "lists/image_list.js",
                    media_external_list_url : "lists/media_list.js",

                    // Style formats
                    style_formats : [
                        {title : 'Bold text', inline : 'b'},
                        {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
                        {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
                        {title : 'Example 1', inline : 'span', classes : 'example1'},
                        {title : 'Example 2', inline : 'span', classes : 'example2'},
                        {title : 'Table styles'},
                        {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
                    ],

                    // Replace values for the template plugin
                    template_replace_values : {
                        username : "Some User",
                        staffid : "991234"
                    }
                });
                $(function() {
                    $( "#tanggal" ).datepicker({
                        changeMonth: true,
                        changeYear: true
                    });
                });
                                
            </script>

            <style type="text/css">
                <!--
                .style3 {
                    color: #62A621;
                    font-weight: bold;
                }
                -->
            </style>
            <?php
            if (in_array($_GET['page'], array('add_tempat', 'edit_tempat', 'maps_kost'))) {
                require_once 'js/maps.php';
            }
            ?>
        </head>
        <body <?php
        if (in_array($_GET['page'], array('add_tempat', 'edit_tempat', 'maps_kost'))) {
            echo 'onload="initMap()"';
        }
            ?>>
            <div class="sidebar">
                <div class="logo clear"><img src="images/logo.png" alt="" width="185" height="80" /></div>
                <?php
                $konfirmasi = mysql_fetch_array(mysql_query('SELECT COUNT(*) AS count FROM pembayaran WHERE konfirmasi= 0'));
                ?>
                <div class="menu">
                    <ul><li><a href="#">MENU UTAMA</a>
                            <ul>
                                <li><a href='?page=home'><b>Home</b></a></li>
                                <li><a href='?page=admin'><b>Admin</b></a></li>
                                <li><a href='?page=pemilik'><b>Pemilik</b></a></li>
                                <li><a href='?page=kost'><b>Kost</b></a></li>
                                <li><a href='?page=pelanggan'><b>Pelanggan</b></a></li>
                                <li><a href='?page=periode'><b>Periode</b></a></li>
                                <li><a href='?page=bank'><b>Bank</b></a></li>
                                <li><a href='?page=fasilitas'><b>Fasilitas</b></a></li>
                                <li><a href='?page=pemesanan'><b>Pemesanan</b></a></li>
                                <li><a href='?page=pembayaran'><b>Pembayaran <?php if($konfirmasi['count'] > 0) echo '<i style="color:red;">( '.$konfirmasi['count'].' )</i>' ?></b></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="main"> <!-- *** mainpage layout *** -->
                <div class="main-wrap">
                    <div class="header clear">
                        <ul class="links clear">
                            <li>:::: <strong>Selamat Datang <?php echo $_SESSION['admin']['nama']; ?></strong>&nbsp;::::&nbsp;</li>
                            <li><a href="?p=home"><img src="images/home.png" alt="" class="icon" /> <span class="text">Beranda</span></a></li>
                            <li><a href="../" target="_blank"><img src="images/ico_view_24.png" alt="" class="icon" /> <span class="text">Lihat Website</span></li>

                            <li><a href="logout.php"><img src="images/ico_logout_24.png" alt="" class="icon" /> <span class="text">Keluar</span></a></li>
                        </ul>
                    </div>

                    <div class="page clear">			
                        <!-- MODAL WINDOW -->
                        <div id="modal" class="modal-window">
                            <!-- <div class="modal-head clear"><a onclick="$.fancybox.close();" href="javascript:;" class="close-modal">Close</a></div> -->


                        </div>

                        <!-- CONTENT BOXES -->
                        <!-- end of content-box -->
                        <div class="notification note-success">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="2%">&nbsp;</td>
                                    <td width="95%">
                                        <?php
                                        //Content
                                        if ($_GET[page] == "home" || $_GET[page] == "") {
                                            echo "<h2>Selamat Datang</h2>
                                                <p>Hai <b>".$_SESSION['admin']['nama']."</b>, selamat datang di halaman Administrator.<br> Silahkan klik menu pilihan yang berada 
                                                di sebelah kiri untuk mengelola konten website anda. </p>
                                                <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
                                                <p align=right>Login : ".$_SESSION['admin']['login_time']."</p>";
                                        } else {
                                            if(isset($_GET['p']) && !empty($_GET['p'])){
                                                $_SESSION['admin']['pagination'][$_GET['page']] = $_GET['p'];
                                            }else{
                                                $_SESSION['admin']['pagination'][$_GET['page']] = 1;
                                            }
                                            $args = explode('_', $_GET[page]);
                                            if (isset($args[1])) {
                                                require_once("modul/$args[1]/$args[0].php");
                                            } else {
                                                require_once("modul/$args[0]/view.php");
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td width="3%">&nbsp;</td>
                                </tr>
                            </table>
                        </div>
                        <div class="clear">
                            <!-- end of content-box -->

                        </div><!-- end of page -->

                        <div class="footer clear"></div>
                    </div>
                </div>
            </div>
            <div style="clear: both"></div>
        </body>
    </html>
    <?php
}
?>