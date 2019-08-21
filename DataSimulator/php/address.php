<?php
// Loads the DatabaseConnection.php file that will connect the webpage to the database
include 'DatabaseConnection.php';
if(isset($_POST['customerId'])){
    $customerId = $_POST['customerId'];
    $selectAddressSql = "SELECT AddressID, Address FROM Address WHERE CustomerID=$customerId";
    $selectAddressResult = sqlsrv_query($connection,$selectAddressSql);
    while($row = sqlsrv_fetch_array($selectAddressResult,SQLSRV_FETCH_ASSOC)){
        echo '<option value="' . $row["AddressID"] . '">' . $row["Address"] . '</option>', PHP_EOL;
    }
}
?>