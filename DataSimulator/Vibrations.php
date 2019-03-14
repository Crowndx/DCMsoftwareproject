<?php
include 'DatabaseConnection.php';
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
    $date = date("Y/m/d h:i:s");
    $sqlInsert = "INSERT INTO Vibration(VibrationID,Vibration,DateTime,MotorID) VALUES(?,?,?,?)";
    $params = array($counter,$vibration,$date,$motorID);
    $insertStatement = sqlsrv_query($connection,$sqlInsert,$params);
    if( $insertStatement === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    if($counter > 10){
        $machineOn = 0;
    }
}
?>