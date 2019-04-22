<?php
include 'DatabaseConnection.php';
/*
 * Gets the 30 newest vibrations from the vibration table that have the same motorID as the one provided by the post request
 * Sorts them in DESCENDING order to make sure its the newest vibration values
 * Puts them in an array and returns the array to the javascript ajax request that called the script
 */ 
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