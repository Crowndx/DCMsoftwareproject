<?php
/*
 * Connects to the database provided by the DatabaseConnection php script
 * Retrieves the post request parameters and stores them in the variables
 */
include 'php/DatabaseConnection.php';
$machineId = $_POST['machine'];
$motorId = $_POST['motor'];
$minimumValueVib = $_POST['minValueVib'];
$maxValueVib = $_POST['maxValueVib'];
$minimumValueTemp = $_POST['minValueTemp'];
$maxValueTemp = $_POST['maxValueTemp'];
$cycles = $_POST['cycles'];

/*
 * This block of code is responsible for retrieving the current runtime of the machine based on the machine id passed in from the index form
 * Creates a SQL query to get the runtime
 * Runs the sql query on the database
 * Creates a variable to hold the result $machineRuntime
 * Sets $machineRuntime equal to the result retrieved from the database($row)
 */
$selectMachineRuntime = "SELECT RunTime FROM Machine WHERE MachineID=$machineId";
$machineRuntimeSelectStatement = sqlsrv_query($connection,$selectMachineRuntime);
$machineRuntime = 0;
while($row = sqlsrv_fetch_array($machineRuntimeSelectStatement,SQLSRV_FETCH_ASSOC)){
    $machineRuntime = $row["RunTime"];
}

/*
 * This block of code is responsible for retrieving the current runtime of the motor based on the motor id passed in from the index form
 * Creates a SQL query to get the runtime
 * Runs the sql query on the database
 * Creates a variable to hold the result $motorRuntime
 * Sets $motorRuntime equal to the result retrieved from the database($row)
 */
$selectMotorRuntime = "SELECT RunTime FROM Motor WHERE MotorID=$motorId";
$motorRuntimeSelectStatement = sqlsrv_query($connection,$selectMotorRuntime);
$motorRuntime = 0;
while($row = sqlsrv_fetch_array($motorRuntimeSelectStatement,SQLSRV_FETCH_ASSOC)){
    $motorRuntime = $row["RunTime"];
}

/*
 * This block is responsible for updating the machines on or off status to ON based on the machineId passed in from the form
 */
$sqlUpdateMachineOn = "UPDATE Machine SET OnOff = 1 WHERE MachineID=$machineId";
$machineOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMachineOn);

/*
 * This block is responsible for updating a motor's on or off status to ON based on the motorId passed in from the form
 */
$sqlUpdateMotorOn = "UPDATE Motor SET OnOff = 1 WHERE MotorID=$motorId";
$machineOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMotorOn);

/*
 * This block of code is responsible for retrieving the current On or Off status of the machine based on the machine id passed in from the index form
 * Creates a SQL query to get the On or Off status
 * Runs the sql query on the database
 * Creates a variable to hold the result $machineOn
 * Sets $machineOn equal to the result retrieved from the database($row)
 */
$selectMachineOn = "SELECT OnOff FROM Machine WHERE MachineID=$machineId";
$machineOnSelectStatement = sqlsrv_query($connection,$selectMachineOn);
$machineOn = 0;
while($row = sqlsrv_fetch_array($machineOnSelectStatement,SQLSRV_FETCH_ASSOC)){
    $machineOn = $row["OnOff"];
}
    
$counter = 0;                                                 // This counter is just used to tell how many times the loop has run
while($machineOn === 1){                                      // Runs while the machine is "On"
    $counter = $counter + 1;  
    usleep(250000);                                           // Makes the program wait .25 seconds to run
    $date = date("Y/m/d h:i:s");                              // Gets the current date and time
    $vibration = rand($minimumValueVib,$maxValueVib);         // Creates a random vibration value based on the provided minimum and maximum vibration values
    $sqlInsertVibration = "INSERT INTO Vibration(Vibration,DateTime,MotorID) VALUES(?,?,?)";
    $params = array($vibration,$date,$motorId);               // Prepared statement to hold the variables instead of having them in the SQL statement
    $insertStatementVibration = sqlsrv_query($connection,$sqlInsertVibration,$params);

    if($counter % 4 === 0){                                   // Makes sure that every 4 vibration value creations we will create a temperature value      
        $machineRuntime = $machineRuntime + 1;                // Increment the machines runtime by 1
        $motorRuntime = $motorRuntime + 1;                    // Increment the motors runtime by 1
        $temperature = rand($minimumValueTemp, $maxValueTemp);// Creates a random temperature value based on the provided minimum and maximum temperature values
        
        // Inserts a new temperature into the Temperature table with the created temperature the current date and which motorId it's for
        $sqlInsertTemperature = "INSERT INTO Temperature(Temperature,DateTime,MotorID) VALUES(?,?,?)";
        $params = array($temperature,$date,$motorId);         // Prepared statement to hold the variables instead of having them in the SQL statement
        $insertStatementTemperature = sqlsrv_query($connection,$sqlInsertTemperature,$params);

        // Updates the currently running machine's runtime 
        $sqlUpdateMachineRuntime = "UPDATE Machine SET Runtime = $machineRuntime WHERE MachineID=$machineId";
        $machineOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMachineRuntime);

        // Updates the currently running motor's runtime
        $sqlUpdateMotorRuntime = "UPDATE Motor SET Runtime = $motorRuntime WHERE MotorID=$motorId";
        $motorOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMotorRuntime);
    }
    if($counter > $cycles * 4){                             // Makes the loop stop once the counter is larger than cycles * 4                  
        $machineOn = 0;                                     // Sets the machine to "OFF" to stop the loop

        // Updates the current machines On or Off status to off
        $sqlUpdateMachineOn = "UPDATE Machine SET OnOff = 0 WHERE MachineID=$machineId";
        $machineOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMachineOn);

        // Updates the current motors On or Off status to off
        $sqlUpdateMotorOn = "UPDATE Motor SET OnOff = 0 WHERE MotorID=$motorId";
        $motorOnUpdateStatement = sqlsrv_query($connection,$sqlUpdateMotorOn);       
    }
}
?>