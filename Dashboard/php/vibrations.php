<?php
include 'DatabaseConnection.php';
if(isset($_POST["MotorID"])){
    $motorId = $_POST["MotorID"];
    $selectVibrationsSQL = "SELECT TOP 30 Vibration FROM Vibration WHERE MotorID = $motorId ORDER BY VibrationID DESC";
    $vibrationsSelectResults = sqlsrv_query($connection,$selectVibrationsSQL);
    $result = [];
    while($row = sqlsrv_fetch_array($vibrationsSelectResults,SQLSRV_FETCH_ASSOC)){
        array_push($result,($row["Vibration"]));
    }
    echo json_encode($result);
}
?>