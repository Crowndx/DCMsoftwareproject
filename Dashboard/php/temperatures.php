<?php
include 'DatabaseConnection.php';
/*
 * Gets the 30 newest temperatures from the temperature table that have the same motorID as the one provided by the post request
 * Sorts them in DESCENDING order to make sure its the newest temperature values
 * Puts them in an array and returns the array to the javascript ajax request that called the script
 */ 
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