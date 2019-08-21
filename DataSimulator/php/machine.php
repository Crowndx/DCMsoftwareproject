<?php
// Loads the DatabaseConnection.php file that will connect the webpage to the database
include 'DatabaseConnection.php';
if(isset($_POST['addressId'])){
    $addressId = $_POST['addressId'];
    $selectMachineSql = "SELECT MachineID, MachineFunction FROM Machine WHERE AddressID=$addressId";
    $selectMachineResult = sqlsrv_query($connection,$selectMachineSql);
    while($row = sqlsrv_fetch_array($selectMachineResult,SQLSRV_FETCH_ASSOC)){
        echo '<option value="' . $row["MachineID"] . '">' . $row["MachineFunction"] . '</option>', PHP_EOL;
    }
}
?>