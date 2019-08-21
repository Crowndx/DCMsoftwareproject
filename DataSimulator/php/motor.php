<?php
// Loads the DatabaseConnection.php file that will connect the webpage to the database
include 'DatabaseConnection.php';
if(isset($_POST['machineId'])){
    $machineId = $_POST['machineId'];
    $selectMotorSql = "SELECT MotorID, MotorNumber FROM Motor WHERE MachineID=$machineId";
    $selectMotorResult = sqlsrv_query($connection,$selectMotorSql);
    while($row = sqlsrv_fetch_array($selectMotorResult,SQLSRV_FETCH_ASSOC)){
        echo '<option value="' . $row["MotorID"] . '">' . $row["MotorNumber"] . '</option>', PHP_EOL;
    }
}
?>