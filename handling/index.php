<?php
//include 'DatabaseConnection.php';

//spoofed data to simulate what will be queried from the database
$customerLocations = array("Grimsby", "Hamilton");
$machineIds = array("grimsby1", "grimsby2", "hamilton1", "hamilton2");
$motors = array("11", "12", "21", "22");
$motorData = array(array("motor1"),
					array("motor2"),
					array("motor3"),
					array("motor4"));
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
                    <div class="dropdown" id="customer"> <!-- Customer drop down menu -->
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Customer</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">         
							<a class="dropdown-item" href="#">Handling Specialty</a>		
                        </div>
                    </div>
                    <div class="dropdown" id="location"> <!-- Location drop down menu -->
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Location</button>
                        <div id="locations" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        </div>
                    </div>
                    <div class="dropdown" id="machine"> <!-- Machine drop down menu -->
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Machine</button>
                        <div id="machines" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        </div>
                    </div>
                    <ul id="machineInfo">
                        <li>Machine 1</li>
                        <li>ON | OFF</li>
                        <li>[Machine Status]1</li>
                        <li>D29:H12:M30:S10</li>
                        <li>D00:H11:M30:S50</li>
                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" id="summary">
                    <div class="container">
                        <div class="row" id="summaryInfo">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 border">
                                <h3 class="topLabel">Customer</h3>
                                <h3 class="bottomLabel">Handling Specialty</h3>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 border">
                                <h3 class="topLabel">Machine Location</h3>
                                <h3 class="bottomLabel">Hamilton, Ontario, Canada</h3>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 border">
                                <h3 class="topLabel">Function</h3>
                                <h3 class="bottomLabel">Engine Work Station Lift System</h3>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 border">
                                <h3 class="topLabel">Monitoring</h3>
                                <h3 class="bottomLabel">Temperature, Vibration, Runtime of Two 20HP Motor/Gearbox combinations line shafted together. Overall machine runtime for maintenance scheduling.</h3>
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
							<div class="col-sm border">
								<h6 class="topLabel">Motor 3</h6>
								<p id="leftHalf">ON | OFF</p>
								<p id="rightHalf">[Runtime]</p>
								<p>Motor Temperature [Motor temp]</p>
							</div>
							<div class="col-sm border">
								<h6 class="topLabel">Motor 4</h6>
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
		var locationItems = locationDropdown.getElementsByTagName("*");
		for (var i = 0; i < locationItems.length; i++) {
			var curr = locationItems[i];

			curr.addEventListener('click', function() {
				var locationChildren = document.getElementById("locations").children;
				for (var i = 0; i < locationChildren.length; i++) {
					locationChildren[i].classList.remove("selected");
				}
				this.classList.add("selected");
			});
		}
		
		//populate the machine dropdown in the nav bar on the left side
		var machines = <?php echo json_encode($machineIds); ?>;
		var machineDropdown = document.getElementById("machines");
		for (var i = 0; i < machines.length; i++) {
			var node = "<a class='dropdown-item' href='#'>" + machines[i] + "</a>";
			machineDropdown.innerHTML += node;
		}
		
		var ctx = document.getElementById("motor1Temperature").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["60", "55", "50", "45", "40", "35", "30", "25", "20", "15", "10", "5", "0"],
				datasets: [{
					label: 'Temperature of Motor',
					data: [30,33,28,26,25,23,27,34,39,46,58,66,70],
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
							labelString: 'Time up to an hour ago'
						}
					}]
				}
			}
		});
		
		var ctx = document.getElementById("motor1Vibration").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["60", "55", "50", "45", "40", "35", "30", "25", "20", "15", "10", "5", "0"],
				datasets: [{
					label: 'Vibration of Motor',
					data: [67,60,54,60,70,85,100,120,110,100,85,80],
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
							labelString: 'Time up to an hour ago'
						}
					}]
				}
			}
		});
		</script>
    </body>
</html>
