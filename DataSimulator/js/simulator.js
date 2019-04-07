$(document).ready(function () {
    var customerId = $('#customers').change(function () {
        return $('#customers').children("option:selected").val();
    });
    var addressId = $('#address').change(function () {
        return $('#address').children("option:selected").val();
    }); 
    var machineId = $('#machine').change(function () {
        return $('#machine').children("option:selected").val();
    }); 
    var motorId = $('#motor').change(function () {
        return $('#motor').children("option:selected").val();
    }); 
});