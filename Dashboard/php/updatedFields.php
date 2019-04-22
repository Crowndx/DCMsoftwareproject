<?php
include 'DatabaseConnection.php';
/*
 * This php script checks to see if the machine is on or off in the database
 * will return to the calling ajax function updateMachinesOnOff
 * Either the machine is on or the machine if off to display on the dashboard    
 */
if(isset($_POST["machineOnOff"])){
    $selectMachineOnSQL = "SELECT OnOff FROM Machine WHERE MachineID = 1";
    $machineOnSelectResults = sqlsrv_query($connection,$selectMachineOnSQL);
    $result = "";
    while($row = sqlsrv_fetch_array($machineOnSelectResults,SQLSRV_FETCH_ASSOC)){
        if($row["OnOff"] == 0){
            $result = "Machine is: OFF";
        };
        if($row["OnOff"] == 1){
            $result = "Machine is: ON";
        };
    }
    echo json_encode($result);
}

/*
 * This php script checks to see if motor 1 is on or off in the database
 * will return to the calling ajax function updateMotor1OnOff
 * Either the motor is on or the motor if off to display on the dashboard    
 */
else if(isset($_POST["machineOneOn"])){
    $selectMotor1OnSQL = "SELECT OnOff FROM Motor WHERE MachineID = 1 AND MotorID = 1";
    $motor1OnSelectResults = sqlsrv_query($connection,$selectMotor1OnSQL);
    $result = "";
    while($row = sqlsrv_fetch_array($motor1OnSelectResults,SQLSRV_FETCH_ASSOC)){
        if($row["OnOff"] == 0){
            $result = "Motor is: OFF";
        };
        if($row["OnOff"] == 1){
            $result = "Motor is: ON";
        };
    }
    
    echo json_encode($result);
}

/*
 * This php script checks to see if motor 2 is on or off in the database
 * will return to the calling ajax function updateMotor1OnOff
 * Either the motor is on or the motor if off to display on the dashboard    
 */
else if(isset($_POST["machineTwoOn"])){
    $selectMotor2OnSQL = "SELECT OnOff FROM Motor WHERE MachineID = 1 AND MotorID = 2";
    $motor2OnSelectResults = sqlsrv_query($connection,$selectMotor2OnSQL);
    $result = "";
    while($row = sqlsrv_fetch_array($motor2OnSelectResults,SQLSRV_FETCH_ASSOC)){
        if($row["OnOff"] == 0){
            $result = "Motor is: OFF";
        };
        if($row["OnOff"] == 1){
            $result = "Motor is: ON";
        };
    }
    
    echo json_encode($result);
}
/*
 * This php script checks to see what the fault id the machine has 
 * will return to the calling ajax function updateFaults
 * Will display the fault description to the dashboard 
 */
else if(isset($_POST["machineFaults"])){
    $selectMachineStatusSQL = "SELECT FaultID FROM Machine WHERE MachineID = 1";
    $machineOnSelectResults = sqlsrv_query($connection,$selectMachineStatusSQL);
    $result = "";
    $faultId = 0;
    while($row = sqlsrv_fetch_array($machineOnSelectResults,SQLSRV_FETCH_ASSOC)){
        $faultId = $row["FaultID"];
    }
    $selectFaultMessageSQL = "SELECT FaultDescription FROM Faults WHERE FaultID = $faultId";
    $machineFaultMessageResult = sqlsrv_query($connection, $selectFaultMessageSQL);
    while($row = sqlsrv_fetch_array($machineFaultMessageResult,SQLSRV_FETCH_ASSOC)){
        $result = "Faults: " . $row["FaultDescription"];
    }
    
    echo json_encode($result);
}

/*
 * This php script checks to see what the runtime of motor 1 is 
 * will return to the calling ajax function updateMotor1Maintenance
 * Will display the motor 1's runtime to the dashboard once the function is complete
 */
else if(isset($_POST["motorOneMaintenance"])){
    $selectMotor1RuntimeSQL = "SELECT Runtime FROM Motor WHERE MachineID = 1 AND MotorID = 1";
    $motor1RuntimeSelectResults = sqlsrv_query($connection,$selectMotor1RuntimeSQL);
    $result = "";
    while($row = sqlsrv_fetch_array($motor1RuntimeSelectResults,SQLSRV_FETCH_ASSOC)){
        $result = "Runtime: " . $row["Runtime"] . " seconds since last maintenance.";
    }
    echo json_encode($result);
}

/*
 * This php script checks to see what the runtime of motor 2 is 
 * will return to the calling ajax function updateMotor1Maintenance
 * Will display the motor 2's runtime to the dashboard once the function is complete
 */
else if(isset($_POST["motorTwoMaintenance"])){
    $selectMotor2RuntimeSQL = "SELECT Runtime FROM Motor WHERE MachineID = 1 AND MotorID = 2";
    $motor2RuntimeSelectResults = sqlsrv_query($connection,$selectMotor2RuntimeSQL);
    $result = "";
    while($row = sqlsrv_fetch_array($motor2RuntimeSelectResults,SQLSRV_FETCH_ASSOC)){
        $result = "Runtime: " . $row["Runtime"] . " seconds since last maintenance.";
    }
    echo json_encode($result);
}

/*
 * This php script checks to see how long till the machine needs maintenance
 * will return to the calling ajax function updateMachineUntilMaintenance
 * Will display how many seconds the machine can run until it needs maintenance
 */
else if(isset($_POST["machineUntilMaintenance"])){
    $selectMachineRuntimeSQL = "SELECT Runtime FROM Machine WHERE MachineID = 1";
    $machineRuntimeSelectResults = sqlsrv_query($connection,$selectMachineRuntimeSQL);
    $result = "";
    while($row = sqlsrv_fetch_array($machineRuntimeSelectResults,SQLSRV_FETCH_ASSOC)){
        $timeTillMaintenance = 7890000 - $row["Runtime"];
        $result = $timeTillMaintenance . " seconds till maintenance.";
    }
    echo json_encode($result);
}

/*
 * This php script checks to see how long the machine has been running since maintenance
 * will return to the calling ajax function updateMachineSinceMaintenance
 * Will display how many seconds the machine has run since maintenance
 */
else if(isset($_POST["machineSinceMaintenance"])){
    $selectMachineRuntimeSQL = "SELECT Runtime FROM Machine WHERE MachineID = 1";
    $machineRuntimeSelectResults = sqlsrv_query($connection,$selectMachineRuntimeSQL);
    $result = "";
    while($row = sqlsrv_fetch_array($machineRuntimeSelectResults,SQLSRV_FETCH_ASSOC)){
        $result = "Runtime: " . $row["Runtime"] . " seconds since last maintenance.";
    }
    echo json_encode($result);
}
?>