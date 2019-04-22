var chartMotor1Temperature;
var chartMotor2Temperature;
var chartMotor1Vibration;
var chartMotor2Vibration;
$(document).ready(function () {
    var labelArray = [];
    var counter = 1;
    while (counter <= 30) {
        labelArray.push(counter);
        counter += 1;
    }

    //This block of code is responsible for initializing the temperature graph of motor 1
    var ctx = document.getElementById("motor1Temperature").getContext('2d');
    chartMotor1Temperature = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelArray,
            datasets: [{
                label: 'Temperature of Motor',
                data: [],
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
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMin: 0,
                        max: 300,
                        stepSize: 20
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Degrees Celsius'
                    }
                }],

                xAxes: [{
                    ticks: {
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Last 30 seconds of runtime'
                    }
                }]
            }
        }
    });

    //This block of code is responsible for initializing the vibration graph of motor 1
    var ctx = document.getElementById("motor1Vibration").getContext('2d');
    chartMotor1Vibration = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelArray,
            datasets: [{
                label: 'Vibration of Motor',
                data: [],
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
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMin: 0,
                        max: 60000,
                        stepSize: 2000
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
                        labelString: 'Last 30 seconds of runtime'
                    }
                }]
            }
        }
    });

    //This block of code is responsible for initializing the temperature graph of motor 2
    var ctx_live_temp = document.getElementById("motor2Temperature").getContext('2d');
    chartMotor2Temperature = new Chart(ctx_live_temp, {
        type: 'line',
        data: {
            labels: labelArray,
            datasets: [{
                label: 'Temperature of Motor',
                data: [],
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
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMin: 0,
                        max: 300,
                        stepSize: 20
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Degree Celsius'
                    }
                }],

                xAxes: [{
                    ticks: {
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Last 30 seconds of runtime'
                    }
                }]
            }
        }
    });

    //This block of code is responsible for initializing the vibration graph of motor 2
    var ctx_live_vib = document.getElementById("motor2Vibration").getContext('2d');
    chartMotor2Vibration = new Chart(ctx_live_vib, {
        type: 'line',
        data: {
            labels: labelArray,
            datasets: [{
                label: 'Vibration',
                data: [],
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
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMin: 0,
                        max: 60000,
                        stepSize: 2000
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
                        labelString: 'Last 30 seconds of runtime'
                    }
                }]
            }
        }
    });
});