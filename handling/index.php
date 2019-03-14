<?php
include 'DatabaseConnection.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Handling Specialty - Custom Material Handling Equipment</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="bootstrapcss/bootstrap.min.css" rel="stylesheet" type="text/css"/>		
		<link href="StyleSheet1.css" rel="stylesheet" type="text/css" />
        <style>

        </style>
    </head>
    <body>		
		<div id="container">
            <div id="page-header">
                <img src="images/handlinglogo.png" />
            </div>         
			<div class="row">
				<div class="col-12 col-md-3 col-xl-2 bd-sidebar">
                    <div class="dropdown" id="customer"><!-- Customer drop down menu -->
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown button
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Handling</a>
                            <a class="dropdown-item" href="#">Mohawk</a>
                            <a class="dropdown-item" href="#">Maple Leaf</a>
                        </div>
                    </div>
                    <div class="dropdown" id="location"> <!-- Location drop down menu -->
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown button
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Hamilton</a>
                            <a class="dropdown-item" href="#">Guelph</a>
                            <a class="dropdown-item" href="#">Hanon</a>
                        </div>
                    </div>
                    <div class="dropdown" id="machine"> <!-- Machine drop down menu -->
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown button
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Machine 1</a>
                            <a class="dropdown-item" href="#">Machine 2</a>
                            <a class="dropdown-item" href="#">Machine 3</a>
                        </div>
                    </div>
                    <ul>
                        <li>Machine</li>
                        <li>ON | OFF</li>
                        <li>Machine Status</li>
                        <li>D29:H12:M30:S10</li>
                        <li>D00:H11:M30:S50</li>
                    </ul>
                </div>-->
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <h2>Customer</h2>
                                <h3>Handling Specialty</h3>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <h2>Machine Location</h2>
                                <h3>Hamilton, Ontario</h3>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <h2>Function</h2>
                                <h3>Does this stuff</h3>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <h2>Monitoring</h2>
                                <h3>Temperature, Vibration, Runtime</h3>
                            </div>
                        </div>
                    </div>                  
                </div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-sm">
						<p>Motor 1</p>
					</div>
					<div class="col-sm">
						<p>Motor 2</p>
					</div>
					<div class="col-sm">
						<p>Motor 3</p>
					</div>
					<div class="col-sm">
						<p>Motor 4</p>
					</div>
				</div>	
			</div>
		</div>
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>