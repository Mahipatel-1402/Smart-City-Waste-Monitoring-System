<?php
$c = mysqli_connect('127.0.0.1', 'root', '');
if(!$c) {
    die("Error: " . mysqli_connect_error());
}
echo "Connected with empty password.\n";

$sqlFile = 'wms.sql';
if (file_exists($sqlFile)) {
    mysqli_query($c, "CREATE DATABASE IF NOT EXISTS wms");
    mysqli_select_db($c, "wms");
    $queries = explode(';', file_get_contents($sqlFile));
    $success = 0;
    foreach($queries as $q) {
        $q = trim($q);
        if($q) {
            if(mysqli_query($c, $q)) $success++;
        }
    }
    echo "Imported $success queries.\n";
}
?>
