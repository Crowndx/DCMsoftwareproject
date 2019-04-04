<?php
$serverName = "handlingsoftware.database.windows.net";
$connectionInfo = array("Database" => "Handling", "UID" => "Handling", "PWD" => "DCMsoftware1");
$connection = sqlsrv_connect($serverName, $connectionInfo);
if( $connection ) {
    echo "Connection established.<br />";
}else{
    echo "Connection could not be established.<br />";
    die( print_r( sqlsrv_errors(), true));
}


/*
try {
	$dbh = new PDO("sqlsrv:Server=handlingsoftware.database.windows.net;Database=handling", "handling", "DCMsoftware1");
} catch (Exception $e) {
	die("ERRO: Couldn't connect. {$e->getMessage()}");
}
*/
?>