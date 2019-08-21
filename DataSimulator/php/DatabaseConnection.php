<?php
// Name of the server that will be connected to
$serverName = "handlingsoftware.database.windows.net";
// Name of the database that will be connected to
$connectionInfo = array("Database" => "Handling", "UID" => "Handling", "PWD" => "DCMsoftware1");
// Connects to the database using the provided serverName and connectionInfo
$connection = sqlsrv_connect($serverName, $connectionInfo);
if( $connection ) {
}else{
    echo "Connection could not be established.<br />";
    die( print_r( sqlsrv_errors(), true));
}
?>