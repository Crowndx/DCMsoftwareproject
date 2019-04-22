$(document).ready(function () {
    //.setInterval is used to make the webpage call all the functions every 1 second
    window.setInterval(function () {
        getVibrations(1);
        getVibrations(2);
        getTemperatures(1);
        getTemperatures(2);
        //update status values
        updateMachinesOnOff();
        updateMotor1OnOff();
        updateMotor2OnOff();
        updateFaults();
        updateMotor1Maintenance();
        updateMotor2Maintenance();
        updateMachineUntilMaintenance();
        updateMachineSinceMaintenance();
    }, 1000);
});

/*
 * Function that gets the temperature of the motor in the database that the id provided is equal to
 * Calls the temperatures.php script
 * Passes in the provided motorId to the temperatures.php script with a post request
 * Retrieves the data from the php script and stores it in the data variable
 * Calls the updateTemperatures() function with the provided motorId and the data retrieved from the php script
 */
function getTemperatures(motorId) {
    $.post("php/temperatures.php",
        { MotorID: motorId },
        function (data, status) {
            data = jQuery.parseJSON(data);
            updateTemperatures(motorId, data);
        });
}

/*
 * Function that gets the vibrations of the motor in the database that the id provided is equal to
 * Calls the vibrations.php script
 * Passes in the provided motorId to the vibrations.php script with a post request
 * Retrieves the data from the php script and stores it in the data variable
 * Calls the updateTemperatures() function with the provided motorId and the data retrieved from the php script
 */
function getVibrations(motorId) {
    $.post("php/vibrations.php",
        { MotorID: motorId },
        function (data, status) {
            data = jQuery.parseJSON(data);
            updateVibrations(motorId, data);
        });
}

/*
 * Function responsible for updating the dashboards graphs based on the provided parameters
 * Checks which motor it will be updating the information for
 * Sets the charts data points equal to the provided data parameter
 * Updates the chart.js chart with the new data
 * Sets the element that shows the current temperature of the motor equal to the first item in the provided data array
 */
function updateTemperatures(motorId, data) {
    if (motorId == 1) {
        chartMotor1Temperature.data.datasets[0].data = data;
        chartMotor1Temperature.update();
        document.getElementById("motor1CurrTemp").innerHTML = data[0] + "C";
    }
    else if (motorId == 2) {
        chartMotor2Temperature.data.datasets[0].data = data;
        chartMotor2Temperature.update();
        document.getElementById("motor2CurrTemp").innerHTML = data[0] + "C";
    }
    console.log("updated temperatures with: " + data);
}

/*
 * Function responsible for updating the dashboards graphs based on the provided parameters
 * Checks which motor it will be updating the information for
 * Sets the charts data points equal to the provided data parameter
 * Updates the chart.js chart with the new data
 * Sets the element that shows the current vibration of the motor equal to the first item in the provided data array
 */
function updateVibrations(motorId, data) {
    if (motorId == 1) {
        chartMotor1Vibration.data.datasets[0].data = data;
        chartMotor1Vibration.update();
    } else if (motorId == 2) {
        chartMotor2Vibration.data.datasets[0].data = data;
        chartMotor2Vibration.update();
    }
    console.log("updated vibrations with: " + data);
}

/*
 * Function that gets the On or Off status of a machine
 * Calls the updatedFields.php script
 * Passes in the provided machineOnOff with a post request to the php script
 * Retrieves the data from the php script and stores it in the data variable
 * Sets the On or Off status of the machine on the dashboard equal to the data returned from the script
 */
function updateMachinesOnOff() {
    $.post("php/updatedFields.php",
        { "machineOnOff": "machineOnOff" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("on").innerHTML = data;
        });
}

/*
 * Function that gets the On or Off status of Motor 1
 * Calls the updatedFields.php script
 * Passes in the provided machineOneOn with a post request to the php script
 * Retrieves the data from the php script and stores it in the data variable
 * Sets the On or Off status of motor 1 on the dashboard equal to the data returned from the script
 */
function updateMotor1OnOff() {
    $.post("php/updatedFields.php",
        { "machineOneOn": "machineOneOn" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("motor1LeftHalf").innerHTML = data;
        });
}

/*
 * Function that gets the On or Off status of Motor 2
 * Calls the updatedFields.php script
 * Passes in the provided machineTwoOn with a post request to the php script
 * Retrieves the data from the php script and stores it in the data variable
 * Sets the On or Off status of motor 2 on the dashboard equal to the data returned from the script
 */
function updateMotor2OnOff() {
    $.post("php/updatedFields.php",
        { "machineTwoOn": "machineTwoOn" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("motor2LeftHalf").innerHTML = data;
        });
}

/*
 * Function that gets the Faults associated with the machine
 * Calls the updatedFields.php script
 * Passes in the provided machineFaults with a post request to the php script
 * Retrieves the data from the php script and stores it in the data variable
 * Sets the fault description equal to the data returned from the script
 */
function updateFaults() {
    $.post("php/updatedFields.php",
        { "machineFaults": "machineFaults" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("faults").innerHTML = data;
        });
}


/*
 * Function that gets the runtime of Motor 1
 * Calls the updatedFields.php script
 * Passes in the provided machineOneMaintenance with a post request to the php script
 * Retrieves the data from the php script and stores it in the data variable
 * Sets motor 1's runtime equal on the dashboard equal to the returned data
 */
function updateMotor1Maintenance() {
    $.post("php/updatedFields.php",
        { "motorOneMaintenance": "motorOneMaintenance" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("motor1RightHalf").innerHTML = data;
        });
}

/*
 * Function that gets the runtime of Motor 2
 * Calls the updatedFields.php script
 * Passes in the provided machineOneMaintenance with a post request to the php script
 * Retrieves the data from the php script and stores it in the data variable
 * Sets motor 2's runtime equal on the dashboard equal to the returned data
 */
function updateMotor2Maintenance() {
    $.post("php/updatedFields.php",
        { "motorTwoMaintenance": "motorTwoMaintenance" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("motor2RightHalf").innerHTML = data;
        });
}

/*
 * Function that gets time till maintenance of the machine
 * Calls the updatedFields.php script
 * Passes in the provided machineOneMaintenance with a post request to the php script
 * Retrieves the data from the php script and stores it in the data variable
 * Sets machines time till maintenance on the dashboard equal to the returned data
 */
function updateMachineUntilMaintenance() {
    $.post("php/updatedFields.php",
        { "machineUntilMaintenance": "machineUntilMaintenance" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("untilMaintenance").innerHTML = data;
        });
}

/*
 * Function that gets the runtime of the machine
 * Calls the updatedFields.php script
 * Passes in the provided machineSinceMaintenance with a post request to the php script
 * Retrieves the data from the php script and stores it in the data variable
 * Sets the machines runtime on the dashboard equal to the returned data
 */
function updateMachineSinceMaintenance() {
    $.post("php/updatedFields.php",
        { "machineSinceMaintenance": "machineSinceMaintenance" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("sinceMaintenance").innerHTML = data;
        });
}