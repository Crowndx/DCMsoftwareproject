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
for($i=0; $i<60; $i++){
    $tempArray[i] = rand(15000, 65000);
    $vibrationArray[i] = rand(28000, 32000);
    $runtime = $runtime + 1;
}
$id = 0;
$motor = 1;
foreach($vibrationArray as $vibrations){
    $id++;
    $date = time();
    $vibrationSQLInsert = "INSERT INTO `Handling`.`Vibration` (`VibrationID`,`Vibration`,`DateTime`,`MotorID`) VALUES(`$id`,`$vibrations`,`$date`,`$motor`)";
    $stmtInsert = $dbh->prepare($vibrationSQLInsert);
    $result = $stmtInsert->execute();
}
?>
<!---->