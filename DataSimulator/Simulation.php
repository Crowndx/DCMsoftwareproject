<?php
include 'DatabaseConnection.php';
$machineId = $_POST['machineID'];
$motorId = $_POST['motorID'];
$minimumValueVib = $_POST['minValueVib'];
$maxValueVib = $_POST['maxValueVib'];
$minimumValueTemp = $_POST['minValueTemp'];
$maxValueTemp = $_POST['maxValueTemp'];
$cycles = $_POST['cycles'];

$selectMachineRuntime = "SELECT RunTime FROM Machine WHERE MachineID='$machineId'";
$machineRuntimeSelectStatement = sqlsrv_query($connection,$selectMachineRuntime);
$machineRuntime = $machineRuntimeSelectStatement;
if($machineRuntimeSelectStatement === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

$selectMotorRuntime = "SELECT RunTime FROM Motor WHERE MotorID='$motorId'";
$motorRuntimeSelectStatement = sqlsrv_query($connection,$selectMachineRuntime);
$motorRuntime = $motorRuntimeSelectStatement;
if($motorRuntimeSelectStatement === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

$sqlUpdateMachineOn = "UPDATE 'Machine' SET 'OnOff' = 1 WHERE MachineID='$machineId'";
$machineOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMachineOn);
if( $machineOnUpdateStatement === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

$selectMachineOn = "SELECT OnOff FROM Machine WHERE MachineID='$machineId'";
$machineOnSelectStatement = sqlsrv_query($connection,$selectMachineOn);
$machineOn = $machineOnSelectStatement;
if( $machineOnSelectStatement === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

$counter = 0;
while($machineOn === 1){
    $counter = $counter + 1;
    $machineRuntime = $machineRuntime + 1;
    usleep(250000);
    $date = date("Y/m/d h:i:s");
    $vibration = rand($minimumValueVib,$maxValueVib);
    
    $sqlInsertVibration = "INSERT INTO Vibration(Vibration,DateTime,MotorID) VALUES(?,?,?)";
    $params = array($vibration,$date,$motorId);
    $insertStatementVibration = sqlsrv_query($connection,$sqlInsertVibration,$params);
    if( $insertStatementVibration === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    if($counter % 4 === 0){
        $temperature = rand($minimumValueTemp, $maxValueTemp);
        $sqlInsertTemperature = "INSERT INTO Temperature(Temperature,DateTime,MotorID) VALUES(?,?,?)";
        $params = array($temperature,$date,$motorId);
        $insertStatementTemperature = sqlsrv_query($connection,$sqlInsertTemperature,$params);
        if( $insertStatementTemperature === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
        $sqlUpdateMachineRuntime = "UPDATE 'Machine' SET 'Runtime' = $machineRuntime WHERE MachineID='$machineId'";
        $machineOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMachineRuntime);
        if($machineOnUpdateStatement === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
    }

    if($counter > $cycles){
        $machineOn = 0;
        $sqlUpdateMachineOn = "UPDATE 'Machine' SET 'OnOff' = 0 WHERE MachineID='$machineId'";
        $machineOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMachineOn);
        if($machineOnUpdateStatement === false ) {
            die( print_r( sqlsrv_errors(), true));
        }       
    }
}
?>