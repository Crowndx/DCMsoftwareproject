<?php
include 'php/DatabaseConnection.php';
/*
$sqlCommand = 'SELECT * FROM Handling';
$query = $dbh->query($sqlCommand);
$customerLocations = $query['customer'];
*/

//spoofed data to simulate what will be queried from the database
$customerLocations = array("Grimsby", "Hamilton");
$machineIds = array(array("grimsby", "1"), array("grimsby", "2"), array("hamilton", "1"), array("hamilton", "2"));
$motorData = array(array("motor11"),
					array("motor12"),
					array("motor21"),
					array("motor22"));

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
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>		
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
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 border">
                                <h3 class="topLabel">Customer</h3>
                                <h6 class="bottomLabel"><?php
                                    $selectCustomerNameSQL = "SELECT Name FROM Customer WHERE CustomerID = 1";
                                    $customerNameSelectResult = sqlsrv_query($connection,$selectCustomerNameSQL);
                                    while($row = sqlsrv_fetch_array($customerNameSelectResult,SQLSRV_FETCH_ASSOC)){
                                        echo $row["Name"];
                                    }
                                ?></h6>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 border">
                                <h3 class="topLabel">Machine Location</h3>
                                <h6 class="bottomLabel" id="customerLocation"><?php
                                    $selectAddressSQL = "SELECT Address, City, Province, Country FROM Address WHERE CustomerID = 1";
                                    $addressSelectResult = sqlsrv_query($connection,$selectAddressSQL);
                                    while($row = sqlsrv_fetch_array($addressSelectResult,SQLSRV_FETCH_ASSOC)){
                                        echo $row["Address"] . ", " . $row["City"] . ", " . $row["Province"] . ", " . $row["Country"];
                                    }
                                ?></h6>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 border">
                                <h3 class="topLabel">Function</h3>
                                <h6 class="bottomLabel"><?php
                                    $selectMachineFunctionSQL = "SELECT MachineFunction FROM Machine WHERE MachineID = 1";
                                    $machineFunctionSelectResult = sqlsrv_query($connection,$selectMachineFunctionSQL);
                                    while($row = sqlsrv_fetch_array($machineFunctionSelectResult,SQLSRV_FETCH_ASSOC)){
                                        echo $row["MachineFunction"];
                                    }
                                ?></h6>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 border">
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
								<p id="leftHalf">ON | OFF</p>
								<p id="rightHalf">[Runtime]</p>
								<p>Motor Temperature [Motor temp]</p>
								<canvas id="motor1Temperature" width="150px" height="200px"></canvas>
								<canvas id="motor1Vibration" width="150px" height="200px"></canvas>
							</div>
							<div class="col-sm border">
								<h6 class="topLabel">Motor 2</h6>
								<p id="leftHalf">ON | OFF</p>
								<p id="rightHalf">[Runtime]</p>
								<p>Motor Temperature [Motor temp]</p>
							</div>
							
						</div>	
					</div>
                </div>
			</div>		
		</div>
		
		<script>
		
		//populate the locations dropdown in the nav bar on the left side
		var customerLocations = <?php echo json_encode($customerLocations); ?>;
		var locationDropdown = document.getElementById("locations");
		for (var i = 0; i < customerLocations.length; i++) {
			var node = "<a class='dropdown-item' href='#'>" + customerLocations[i] + "</a>";
			locationDropdown.innerHTML += node;
		}
		
		//set a listener on all objects
		var locationItems =  document.getElementById("locations").getElementsByTagName("*");
		for (var i = 0; i < locationItems.length; i++) {
			var curr = locationItems[i];

			//onclick listener for each location item
			curr.addEventListener('click', function() {
				document.getElementById("customerLocation").innerHTML = "" + this.innerHTML + ", Ontario, Canada";
				addMachineListeners(this.innerHTML.toLowerCase());
				var locationChildren = document.getElementById("locations").children;
				for (var i = 0; i < locationChildren.length; i++) {
					locationChildren[i].classList.remove("selected");
				}
				this.classList.add("selected");
			});
		}
		
		function addMachineListeners(location) {
			//populate the machine dropdown in the nav bar on the left side
			var machines = <?php echo json_encode($machineIds); ?>;
			var machineDropdown = document.getElementById("machines");
			machineDropdown.innerHTML = "";
			for (var i = 0; i < machines.length; i++) {
				if(machines[i][0] == location) {
					var node = "<a class='dropdown-item' href='#'>" + machines[i][0] + " " + machines[i][1] + "</a>";
					machineDropdown.innerHTML += node;
				}
			}
			
			addMachineItemsListeners();
		}
		
		function addMachineItemsListeners() {
			//set a listener on all objects
			var machineItems = document.getElementById("machines").getElementsByTagName("*");
			for (var i = 0; i < machineItems.length; i++) {
				var curr = machineItems[i];

				//Onclick listener for each machine item
				curr.addEventListener('click', function() {
					var machineChildren = document.getElementById("machines").children;
					for (var i = 0; i < machineChildren.length; i++) {
						machineChildren[i].classList.remove("selected");
					}
					this.classList.add("selected");
					
					
				});
			}
		}
		
		var ctx = document.getElementById("motor1Temperature").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["30", "29", "28", "27","26","25","24","23","22","21","20","19","18","17","16","15","14","13","12","11","10","9","8","7","6","5","4","3","2","1"],
				datasets: [{
					label: 'Temperature of Motor',
					data: [12,13,4,15,1,15,15,1,14,14,1,16,1,5,15,14,1,4,3,3,34],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							suggestedMin: 0,
							max: 80,
							stepSize: 5
						},
						scaleLabel: {
							display: true,
							labelString: 'Degrees'
						}
					}],
					
					xAxes: [{
						ticks: {
						},
						scaleLabel: {
							display: true,
							labelString: 'Time up to a minute ago'
						}
					}]
				}
			}
		});
		
		var ctx = document.getElementById("motor1Vibration").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["25", "20", "15", "10", "5", "0"],
				datasets: [{
					label: 'Vibration of Motor',
					data: [67,60,54,60,70,85],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							suggestedMin: 0,
							max: 150,
							stepSize: 10
						},
						scaleLabel: {
							display: true,
							labelString: 'Vibration Scale'
						}
					}],
					
					xAxes: [{
						ticks: {
						},
						scaleLabel: {
							display: true,
							labelString: 'Time up to 15 seconds ago'
						}
					}]
				}
			}
		});
		</script>
    </body>
</html>