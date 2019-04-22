<?php
include 'DatabaseConnection.php';

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

else if(isset($_POST["motorOneMaintenance"])){
    $selectMotor1RuntimeSQL = "SELECT Runtime FROM Motor WHERE MachineID = 1 AND MotorID = 1";
    $motor1RuntimeSelectResults = sqlsrv_query($connection,$selectMotor1RuntimeSQL);
    $result = "";
    while($row = sqlsrv_fetch_array($motor1RuntimeSelectResults,SQLSRV_FETCH_ASSOC)){
        $result = "Runtime: " . $row["Runtime"] . " seconds since last maintenance.";
    }
    echo json_encode($result);
}

else if(isset($_POST["motorTwoMaintenance"])){
    $selectMotor2RuntimeSQL = "SELECT Runtime FROM Motor WHERE MachineID = 1 AND MotorID = 2";
    $motor2RuntimeSelectResults = sqlsrv_query($connection,$selectMotor2RuntimeSQL);
    $result = "";
    while($row = sqlsrv_fetch_array($motor2RuntimeSelectResults,SQLSRV_FETCH_ASSOC)){
        $result = "Runtime: " . $row["Runtime"] . " seconds since last maintenance.";
    }
    echo json_encode($result);
}

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