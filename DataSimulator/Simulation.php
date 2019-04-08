<?php
include 'php/DatabaseConnection.php';
$machineId = $_POST['machine'];
$motorId = $_POST['motor'];
$minimumValueVib = $_POST['minValueVib'];
$maxValueVib = $_POST['maxValueVib'];
$minimumValueTemp = $_POST['minValueTemp'];
$maxValueTemp = $_POST['maxValueTemp'];
$cycles = $_POST['cycles'];

$selectMachineRuntime = "SELECT RunTime FROM Machine WHERE MachineID=$machineId";
$machineRuntimeSelectStatement = sqlsrv_query($connection,$selectMachineRuntime);
$machineRuntime = 0;
while($row = sqlsrv_fetch_array($machineRuntimeSelectStatement,SQLSRV_FETCH_ASSOC)){
    $machineRuntime = $row["RunTime"];
}
if($machineRuntimeSelectStatement === false ) {
        die( print_r( sqlsrv_errors(), true));
}

$selectMotorRuntime = "SELECT RunTime FROM Motor WHERE MotorID=$motorId";
$motorRuntimeSelectStatement = sqlsrv_query($connection,$selectMachineRuntime);
$motorRuntime = 0;
while($row = sqlsrv_fetch_array($motorRuntimeSelectStatement,SQLSRV_FETCH_ASSOC)){
    $motorRuntime = $row["RunTime"];
}
if($motorRuntimeSelectStatement === false ) {
        echo "2";
        die( print_r( sqlsrv_errors(), true));
}

$sqlUpdateMachineOn = "UPDATE Machine SET OnOff = 1 WHERE MachineID=$machineId";
$machineOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMachineOn);
if( $machineOnUpdateStatement === false ) {
        die( print_r( sqlsrv_errors(), true));
}

$sqlUpdateMotorOn = "UPDATE Motor SET OnOff = 1 WHERE MotorID=$motorId";
$machineOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMotorOn);
if( $machineOnUpdateStatement === false ) {
        die( print_r( sqlsrv_errors(), true));
}

$selectMachineOn = "SELECT OnOff FROM Machine WHERE MachineID=$machineId";
$machineOnSelectStatement = sqlsrv_query($connection,$selectMachineOn);
$machineOn = 0;
while($row = sqlsrv_fetch_array($machineOnSelectStatement,SQLSRV_FETCH_ASSOC)){
    $machineOn = $row["OnOff"];
}
if( $machineOnSelectStatement === false ) {
        echo "4";
        die( print_r( sqlsrv_errors(), true));
}

$counter = 0;
while($machineOn === 1){ 
    $counter = $counter + 1;  
    usleep(250000);
    $date = date("Y/m/d h:i:s");
    $vibration = rand($minimumValueVib,$maxValueVib);
    $sqlInsertVibration = "INSERT INTO Vibration(Vibration,DateTime,MotorID) VALUES(?,?,?)";
    $params = array($vibration,$date,$motorId);
    $insertStatementVibration = sqlsrv_query($connection,$sqlInsertVibration,$params);
    if( $insertStatementVibration === false ) {
        echo "5";
        die( print_r( sqlsrv_errors(), true));
    }

    if($counter % 4 === 0){        
        $machineRuntime = $machineRuntime + 1;
        $motorRuntime = $motorRuntime + 1;
        $temperature = rand($minimumValueTemp, $maxValueTemp);
        $sqlInsertTemperature = "INSERT INTO Temperature(Temperature,DateTime,MotorID) VALUES(?,?,?)";
        $params = array($temperature,$date,$motorId);
        $insertStatementTemperature = sqlsrv_query($connection,$sqlInsertTemperature,$params);
        if( $insertStatementTemperature === false ) {
            echo "6";
            die( print_r( sqlsrv_errors(), true));
        }
        $sqlUpdateMachineRuntime = "UPDATE Machine SET Runtime = $machineRuntime WHERE MachineID=$machineId";
        $machineOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMachineRuntime);
        if($machineOnUpdateStatement === false ) {
            echo "7";
            die( print_r( sqlsrv_errors(), true));
        }
        $sqlUpdateMotorRuntime = "UPDATE Motor SET Runtime = $motorRuntime WHERE MotorID=$motorId";
        $motorOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMotorRuntime);
        if($machineOnUpdateStatement === false ) {
            echo "7";
            die( print_r( sqlsrv_errors(), true));
        }
    }

    if($counter > $cycles * 4){
        $machineOn = 0;
        $sqlUpdateMachineOn = "UPDATE Machine SET OnOff = 0 WHERE MachineID=$machineId";
        $machineOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMachineOn);
        if($machineOnUpdateStatement === false ) {
            echo "<br>8";
            die( print_r( sqlsrv_errors(), true));
        }
        $sqlUpdateMotorOn = "UPDATE Motor SET OnOff = 0 WHERE MotorID=$motorId";
        $motorOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMotorOn);
        if($machineOnUpdateStatement === false ) {
            echo "<br>8";
            die( print_r( sqlsrv_errors(), true));
        }          
    }
}
?>