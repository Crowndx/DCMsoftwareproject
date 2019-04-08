$(document).ready(function () {
    $("#customers").click(function () {
        $("#address").prop('disabled', false);
        var customerId = $("#customers").children("option:selected").val();
        console.log(customerId);
        $("#address").load("php/address.php", {
            customerId: customerId
        });
        $("#machine").prop('disabled', false);
    });
    $("#address").click(function () {
        var addressId = $("#address").children("option:selected").val();
        $("#machine").load("php/machine.php", {
            addressId: addressId
        });
        $("#motor").prop('disabled', false);
    });
    $("#machine").click(function () {
        var machineId = $("#machine").children("option:selected").val();
        $("#motor").load("php/motor.php", {
            machineId: machineId
        });
    });
});