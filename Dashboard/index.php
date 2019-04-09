<?php
include 'php/DatabaseConnection.php';
/*
$sqlCommand = 'SELECT * FROM Handling';
$query = $dbh->query($sqlCommand);
$customerLocations = $query['customer'];
*/
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Handling Specialty - Custom Material Handling Equipment</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="bootstrapcss/bootstrap.min.css" rel="stylesheet" type="text/css"/>		
		<link href="css/styling.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="chartjs/Chart.bundle.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/charts.js"></script>	
        <script type="text/javascript" src="js/ajaxrequests.js"></script>		
	</head>
    <body>		
		<div id="container">
            <div id="page-header">
                <img id="handlingImage" src="images/handlinglogo.png" />
            </div>         
			<div class="row">
				<div class="col-12 col-md-3 col-xl-2 bd-sidebar" id="sidebar">
                    <form>
                        <div class="form-group">
                            <label for="customers">Customers:</label>
                            <select class="form-control" id="customers" name="customers">
                                <?php 
                                    $selectCustomersSQL = "SELECT * FROM Customer";
                                    $customerSelectStatement = sqlsrv_query($connection,$selectCustomersSQL);
                                    while($row = sqlsrv_fetch_array($customerSelectStatement,SQLSRV_FETCH_ASSOC)){
                                        echo '<option value="' . $row["CustomerID"] . '">' . $row["Name"] . '</option>', PHP_EOL;
                                        $customerName = $row["Name"];
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <select class="form-control" id="address" name="address">
                                <?php 
                                    $selectAddressSQL = "SELECT * FROM Address WHERE CustomerID = 1";
                                    $addressSelectResults = sqlsrv_query($connection,$selectAddressSQL);
                                    while($row = sqlsrv_fetch_array($addressSelectResults,SQLSRV_FETCH_ASSOC)){
                                        echo '<option value="' . $row["AddressID"] . '">' . $row["Address"] . '</option>', PHP_EOL;
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="machines">Machines:</label>
                            <select class="form-control" id="machine" name="machine">
                                <?php 
                                    $selectMachinesSQL = "SELECT * FROM Machine WHERE AddressID = 1 AND MachineID = 1";
                                    $machineSelectResults = sqlsrv_query($connection,$selectMachinesSQL);
                                    while($row = sqlsrv_fetch_array($machineSelectResults,SQLSRV_FETCH_ASSOC)){
                                        echo '<option value="' . $row["MachineID"] . '">' . $row["MachineFunction"] . '</option>', PHP_EOL;
                                    }
                                ?>
                            </select>
                        </div>
                    </form>
                    <ul class="list-group">
                        <li class="list-group-item" id="on"><?php 
                                    $selectMachineOnSQL = "SELECT OnOff FROM Machine WHERE MachineID = 1";
                                    $machineOnSelectResults = sqlsrv_query($connection,$selectMachineOnSQL);
                                    while($row = sqlsrv_fetch_array($machineOnSelectResults,SQLSRV_FETCH_ASSOC)){
                                        if($row["OnOff"] == 0){
                                            echo "Machine is: OFF";
                                        };
                                        if($row["OnOff"] == 1){
                                            echo "Machine is: ON";
                                        };
                                    }
                         ?></li>                    
                        <li class="list-group-item"><?php 
                                    $selectMachineMaintSQL = "SELECT LastMaintenanceDate FROM Machine WHERE MachineID = 1";
                                    $machineMaintSelectResults = sqlsrv_query($connection,$selectMachineMaintSQL);
                                    while($row = sqlsrv_fetch_array($machineMaintSelectResults,SQLSRV_FETCH_ASSOC)){
                                        $date = $row["LastMaintenanceDate"];
                                        echo "Last maintenance was: ". date("Y.m.d", strtotime($date));
                                    }
                         ?></li>
                        <li class="list-group-item"><?php 
                                    $selectMachineRuntimeSQL = "SELECT Runtime FROM Machine WHERE MachineID = 1";
                                    $machineRuntimeSelectResults = sqlsrv_query($connection,$selectMachineRuntimeSQL);
                                    while($row = sqlsrv_fetch_array($machineRuntimeSelectResults,SQLSRV_FETCH_ASSOC)){
                                        echo "Runtime: " . $row["Runtime"] . " seconds since last maintenance.";
                                    }
                         ?></li>
						 <li class="list-group-item"><?php 
                                    $selectMachineRuntimeSQL = "SELECT Runtime FROM Machine WHERE MachineID = 1";
                                    $machineRuntimeSelectResults = sqlsrv_query($connection,$selectMachineRuntimeSQL);
                                    while($row = sqlsrv_fetch_array($machineRuntimeSelectResults,SQLSRV_FETCH_ASSOC)){
                                        $timeTillMaintenance = 7890000 - $row["Runtime"];
                                        echo $timeTillMaintenance . " seconds till maintenance.";
                                    }
                         ?></li>
						 <li class="list-group-item"><?php 
                                    $selectMachineStatusSQL = "SELECT FaultID FROM Machine WHERE MachineID = 1";
                                    $machineOnSelectResults = sqlsrv_query($connection,$selectMachineStatusSQL);
                                    $faultId = 0;
                                    while($row = sqlsrv_fetch_array($machineOnSelectResults,SQLSRV_FETCH_ASSOC)){
                                        $faultId = $row["FaultID"];
                                    }
                                    $selectFaultMessageSQL = "SELECT FaultDescription FROM Faults WHERE FaultID = $faultId";
                                    $machineFaultMessageResult = sqlsrv_query($connection, $selectFaultMessageSQL);
                                    while($row = sqlsrv_fetch_array($machineFaultMessageResult,SQLSRV_FETCH_ASSOC)){
                                        echo "Faults: " . $row["FaultDescription"];
                                    }
                        ?></li>
                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" id="summary">
                    <div class="container">
                        <div class="row" id="summaryInfo">
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 border">
                                <h3 class="topLabel">Customer</h3>
                                <h6 class="bottomLabel"><?php
                                    $selectCustomerNameSQL = "SELECT Name FROM Customer WHERE CustomerID = 1";
                                    $customerNameSelectResult = sqlsrv_query($connection,$selectCustomerNameSQL);
                                    while($row = sqlsrv_fetch_array($customerNameSelectResult,SQLSRV_FETCH_ASSOC)){
                                        echo $row["Name"];
                                    }
                                ?></h6>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 border">
                                <h3 class="topLabel">Machine Location</h3>
                                <h6 class="bottomLabel" id="customerLocation"><?php
                                    $selectAddressSQL = "SELECT Address, City, Province, Country FROM Address WHERE CustomerID = 1";
                                    $addressSelectResult = sqlsrv_query($connection,$selectAddressSQL);
                                    while($row = sqlsrv_fetch_array($addressSelectResult,SQLSRV_FETCH_ASSOC)){
                                        echo $row["Address"] . ", " . $row["City"] . ", " . $row["Province"] . ", " . $row["Country"];
                                    }
                                ?></h6>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 border">
                                <h3 class="topLabel">Machine Info</h3>
                                <h6 class="bottomLabel"><?php
                                    $selectMachineInfoSQL = "SELECT SerialNumber, Model FROM Machine WHERE MachineID = 1";
                                    $machineInfoSelectResult = sqlsrv_query($connection,$selectMachineInfoSQL);
                                    while($row = sqlsrv_fetch_array($machineInfoSelectResult,SQLSRV_FETCH_ASSOC)){
                                        echo "Model: " . $row["Model"] . "<br>" . "Serial Number: " . $row["SerialNumber"];
                                    }
                                ?></h6>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 border">
                                <h3 class="topLabel">Function</h3>
                                <h6 class="bottomLabel"><?php
                                    $selectMachineFunctionSQL = "SELECT MachineFunction FROM Machine WHERE MachineID = 1";
                                    $machineFunctionSelectResult = sqlsrv_query($connection,$selectMachineFunctionSQL);
                                    while($row = sqlsrv_fetch_array($machineFunctionSelectResult,SQLSRV_FETCH_ASSOC)){
                                        echo $row["MachineFunction"];
                                    }
                                ?></h6>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 border">
                                <h3 class="topLabel">Monitoring</h3>
                                <h6 class="bottomLabel"><?php
                                    $selectMachineFunctionSQL = "SELECT MachineMonitoring FROM Machine WHERE MachineID = 1";
                                    $machineFunctionSelectResult = sqlsrv_query($connection,$selectMachineFunctionSQL);
                                    while($row = sqlsrv_fetch_array($machineFunctionSelectResult,SQLSRV_FETCH_ASSOC)){
                                        echo $row["MachineMonitoring"];
                                    }
                                ?></h6>
                            </div>
                        </div>
                    </div>
					<div class="container" id="motorsContainer">
						<div class="row" id="motors">
							<div class="col-sm border">
								<h6 class="topLabel">Motor 1</h6>
								<p id="leftHalf"><?php 
                                    $selectMotor1OnSQL = "SELECT OnOff FROM Motor WHERE MachineID = 1 AND MotorID = 1";
                                    $motor1OnSelectResults = sqlsrv_query($connection,$selectMotor1OnSQL);
                                    while($row = sqlsrv_fetch_array($motor1OnSelectResults,SQLSRV_FETCH_ASSOC)){
                                        if($row["OnOff"] == 0){
                                            echo "Motor is: OFF";
                                        };
                                        if($row["OnOff"] == 1){
                                            echo "Motor is: ON";
                                        };
                                    }
                                ?></p>
								<p id="rightHalf"><?php 
                                    $selectMotor1RuntimeSQL = "SELECT Runtime FROM Motor WHERE MachineID = 1 AND MotorID = 1";
                                    $motor1RuntimeSelectResults = sqlsrv_query($connection,$selectMotor1RuntimeSQL);
                                    while($row = sqlsrv_fetch_array($motor1RuntimeSelectResults,SQLSRV_FETCH_ASSOC)){
                                        echo "Runtime: " . $row["Runtime"] . " seconds since last maintenance.";
                                    }
                                ?></p>
								<p><?php 
                                    $selectMotor1TemperatureSQL = "SELECT TOP 1 Temperature FROM Temperature WHERE MotorID = 1 ORDER BY TemperatureID DESC";
                                    $motor1TemperatureSelectResults = sqlsrv_query($connection,$selectMotor1TemperatureSQL);
                                    while($row = sqlsrv_fetch_array($motor1TemperatureSelectResults,SQLSRV_FETCH_ASSOC)){
                                        echo $row["Temperature"] * 0.005 . "C";
                                    }
                                ?></p>
                                <p id="testing"></p>
								<canvas id="motor1Temperature" width="150px" height="100px"></canvas>
								<canvas id="motor1Vibration" width="150px" height="150px"></canvas>
							</div>
							<div class="col-sm border">
								<h6 class="topLabel">Motor 2</h6>
								<p id="leftHalf"><?php 
                                    $selectMotor2OnSQL = "SELECT OnOff FROM Motor WHERE MachineID = 1 AND MotorID = 2";
                                    $motor2OnSelectResults = sqlsrv_query($connection,$selectMotor2OnSQL);
                                    while($row = sqlsrv_fetch_array($motor2OnSelectResults,SQLSRV_FETCH_ASSOC)){
                                        if($row["OnOff"] == 0){
                                            echo "Motor is: OFF";
                                        };
                                        if($row["OnOff"] == 1){
                                            echo "Motor is: ON";
                                        };
                                    }
                                ?></p>
								<p id="rightHalf"><?php 
                                    $selectMotor2RuntimeSQL = "SELECT Runtime FROM Motor WHERE MachineID = 1 AND MotorID = 2";
                                    $motor2RuntimeSelectResults = sqlsrv_query($connection,$selectMotor2RuntimeSQL);
                                    while($row = sqlsrv_fetch_array($motor2RuntimeSelectResults,SQLSRV_FETCH_ASSOC)){
                                        echo "Runtime: " . $row["Runtime"] . " seconds since last maintenance.";
                                    }
                                ?></p>
								<p><?php 
                                    $selectMotor2TemperatureSQL = "SELECT TOP 1 Temperature FROM Temperature WHERE MotorID = 2 ORDER BY TemperatureID DESC";
                                    $motor2TemperatureSelectResults = sqlsrv_query($connection,$selectMotor2TemperatureSQL);
                                    while($row = sqlsrv_fetch_array($motor2TemperatureSelectResults,SQLSRV_FETCH_ASSOC)){
                                        echo $row["Temperature"] * 0.005 . "C";
                                    }
                                ?></p>
                                <canvas id="motor2Temperature" width="150px" height="100px"></canvas>
								<canvas id="motor2Vibration" width="150px" height="150px"></canvas>
							</div>
						</div>	
					</div>
                </div>
			</div>		
		</div>
    </body>
</html>