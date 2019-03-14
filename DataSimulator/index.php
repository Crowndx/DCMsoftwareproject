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
$runtime = 0;
$machineOn = 1;
$motorOn = 1;
$motorID = 1;
$counter = 0;
while($machineOn === 1 && $motorOn === 1){
    $counter = $counter + 1;
    $runtime = $runtime + 1;
    usleep(250000);
    $vibration = rand(28000,32000);
    $date = date("d/m/y h:i:s A");
    /* Begin the transaction. */
    if ( sqlsrv_begin_transaction( $conn ) === false ) {
        die( print_r( sqlsrv_errors(), true ));
    }
    $sqlInsert = "INSERT INTO Vibration(VibrationID,Vibration,DateTime,MotorID) VALUES(`NULL`, `$vibration`, `$date`, `$motorID`)";
    $insertStatement = sqlsrv_query($connection,$sqlInsert);
    if($insertStatement){
        sqlsrv_commit($connection);
        echo "Vibrations added.<br />";
    }
    else{
        sqlsrv_rollback($connection);
        echo "Vibration not added.<br />";
    }
    if($counter > 10){
        $machineOn = 0;
    }
}
?>