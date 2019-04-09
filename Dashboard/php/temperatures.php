<?php
include 'DatabaseConnection.php';
if(isset($_POST["MotorID"])){
    $motorId = $_POST["MotorID"];
    $selectTemperatureSQL = "SELECT TOP 30 Temperature FROM  Temperature WHERE MotorID = $motorId ORDER BY TemperatureID DESC";
    $TemperatureSelectResults = sqlsrv_query($connection,$selectTemperatureSQL);
    $result = [];
    while($row = sqlsrv_fetch_array($TemperatureSelectResults,SQLSRV_FETCH_ASSOC)){
        array_push($result,($row["Temperature"]));
    }
    echo json_encode($result);
}
?>