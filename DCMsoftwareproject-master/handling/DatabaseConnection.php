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
?>