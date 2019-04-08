$(document).ready(function () {
    $("#customers").change(function () {
        $("#address").prop('disabled', false);
        var customerId = $("#customers").children("option:selected").val();
        $("#address").load("address.php", {
            customerId: customerId
        });
    });
    $("#address").change(function () {
        $("#machine").prop('disabled', false);
        var addressId = $("#address").children("option:selected").val();
        $("#machine").load("machine.php", {
            addressId: addressId
        });
    });
    $("#machine").change(function () {
        $("#motor").prop('disabled', false);
        var machineId = $("#machine").children("option:selected").val();
        $("#motor").load("motor.php", {
            machineId: machineId
        });
    });
});