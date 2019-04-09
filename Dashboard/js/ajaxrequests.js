$(document).ready(function () {
    var vibrationArray1;
    var vibrationArray2;
    var temperatureArrayMotor1;
    var temperatureArrayMotor2;
    vibrationArray1 = getVibrations(1);
    vibrationArray2 = getVibrations(2);
    temperatureArrayMotor1 = getTemperatures(1);
    temperatureArrayMotor2 = getTemperatures(2);
    console.log(temperatureArrayMotor1);
    console.log(temperatureArrayMotor2);
    console.log(vibrationArray1);
    console.log(vibrationArray2);

    function getTemperatures(motorId) {
        $.post("php/temperatures.php", {
            MotorID: motorId
        }, function (data, status) {
            data = jQuery.parseJSON(data);
            return data;
        });
    }
    function getVibrations(motorId) {
        $.post("php/vibrations.php", {
            MotorID: motorId
        }, function (data, status) {
            data = jQuery.parseJSON(data);
            return data;
        }); 
    }

});
