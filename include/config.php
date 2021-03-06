<?php
$user    = 'root';
$psw     = '';
$db_name      = 'ekasline_shop';

$db = new PDO('mysql:host=127.0.0.1;dbname='.$db_name.';charset=utf8',$user,$psw);

// Setting db attributes
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

define('APP NAME', 'Ekasline Shop Api');
?>