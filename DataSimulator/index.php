<?php
include 'DatabaseConnection.php';

?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Data Simulator Form</title>
    <style>
        #Temperature {
            float: left;
        }
        #Vibrations{
	        float:left;
        }
        #submitButton{
            margin-left: 10px;
            margin-top: 10px;
        }
        #resetButton{
            margin-top: 10px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
<div id ="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<form action="https://handlingsoftware.azurewebsites.net/DataSimulator/Simulation.php" method="post" id= "simulator">
				<div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4" id="selections">
                        <h1>Selections</h1>                        
                        <label for="customers">Customers:</label>
                        <select id="customers">
                            <?php 
                                $selectCustomersSQL = "SELECT * FROM Customers";
                                $customerSelectStatement = sqlsrv_query($connection,$selectCustomersSQL);
                                while($row = sqlsrv_fetch($customerSelectStatement)){
                                    echo "<option value=\"" . $row['CustomerID'] . "\">" . $row['Name'] . "</option>";
                                }
                            ?>
                        </select>
                        <label for="address">Address:</label>
                        <select id="address" disabled="true">

                        </select>
                        <label for="machine">Machine:</label>
                        <select id="machine" disabled="true">

                        </select>
                        <label for="motor">Motor:</label>
                        <select id="motor" disabled="true">
  
                        </select>
                        <br>
                        <label for="cycles">Cycles: </label>
					    <input type="number" class="form-control" id="cycles">
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="col-sm-6" id="Temperature">
                    <h2>Temperature</h2>  				    
                    <label for="minValueTemp">Min Value: </label>
					<input type="number" class="form-control" id="minValueTemp">
                    <label for="maxValueTemp">Max Value: </label>
					<input type="number" class="form-control" id="maxValueTemp">
                </div>
                <div class="col-sm-6" id="Vibrations">
                    <h2>Vibrations</h2>  				    
                    <label for="minValueVib">Min Value: </label>
					<input type="number" class="form-control" id="minValueVib">
                    <label for="maxValueVib">Max Value: </label>
					<input type="number" class="form-control" id="maxValueVib">                   
                </div>
                <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                <button type="reset" class="btn btn-primary" id="resetButton">Reset</button>
			</form>
		</div>
	</div>
</div>
</body>
</html>
