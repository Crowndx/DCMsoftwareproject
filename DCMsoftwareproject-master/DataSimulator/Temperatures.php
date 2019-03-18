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
    sleep(1);
    $temperature = rand(15000,65000);
    $date = date("Y/m/d h:i:s");
    $sqlInsert = "INSERT INTO Temperature(Temperature,DateTime,MotorID) VALUES(?,?,?)";
    $params = array($temperature,$date,$motorID);
    $insertStatement = sqlsrv_query($connection,$sqlInsert,$params);
    if( $insertStatement === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    if($counter > 10){
        $machineOn = 0;
    }
}
?>