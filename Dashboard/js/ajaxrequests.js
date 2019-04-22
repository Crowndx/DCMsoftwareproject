$(document).ready(function () {
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

function getTemperatures(motorId) {
    $.post("php/temperatures.php",
        { MotorID: motorId },
        function (data, status) {
            data = jQuery.parseJSON(data);
            //console.log("getTemperatures: " + data);
            //Do something with data here
            updateTemperatures(motorId, data);
        });
}

function getVibrations(motorId) {
    $.post("php/vibrations.php",
        { MotorID: motorId },
        function (data, status) {
            data = jQuery.parseJSON(data);
            //console.log("getVibrations: " + data);
            //Do something with data here
            updateVibrations(motorId, data);
        });
}

function updateTemperatures(motorId, data) {
    if (motorId == 1) {
        chartMotor1Temperature.data.datasets[0].data = data;
        chartMotor1Temperature.update();
        document.getElementById("motor1CurrTemp").innerHTML = data[0] + "C";
    } else if (motorId == 2) {
        chartMotor2Temperature.data.datasets[0].data = data;
        chartMotor2Temperature.update();
        document.getElementById("motor2CurrTemp").innerHTML = data[0] + "C";
    }
    console.log("updated temperatures with: " + data);
}

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

function updateMachinesOnOff() {
    $.post("php/updatedFields.php",
        { "machineOnOff": "machineOnOff" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("on").innerHTML = data;
        });
}

function updateMotor1OnOff() {
    $.post("php/updatedFields.php",
        { "machineOneOn": "machineOneOn" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("motor1LeftHalf").innerHTML = data;
        });
}

function updateMotor2OnOff() {
    $.post("php/updatedFields.php",
        { "machineTwoOn": "machineTwoOn" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("motor2LeftHalf").innerHTML = data;
        });
}

function updateFaults() {
    $.post("php/updatedFields.php",
        { "machineFaults": "machineFaults" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("faults").innerHTML = data;
        });
}

function updateMotor1Maintenance() {
    $.post("php/updatedFields.php",
        { "motorOneMaintenance": "motorOneMaintenance" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("motor1RightHalf").innerHTML = data;
        });
}

function updateMotor2Maintenance() {
    $.post("php/updatedFields.php",
        { "motorTwoMaintenance": "motorTwoMaintenance" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("motor2RightHalf").innerHTML = data;
        });
}

function updateMachineUntilMaintenance() {
    $.post("php/updatedFields.php",
        { "machineUntilMaintenance": "machineUntilMaintenance" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("untilMaintenance").innerHTML = data;
        });
}

function updateMachineSinceMaintenance() {
    $.post("php/updatedFields.php",
        { "machineSinceMaintenance": "machineSinceMaintenance" },
        function (data) {
            data = jQuery.parseJSON(data);
            document.getElementById("sinceMaintenance").innerHTML = data;
        });
}