$(document).ready(function () {
    var labelArray = [];
    var counter = 0;
    while (counter <= 30) {       
        labelArray.push(counter);
        counter += 1;
    }
    var ctx_live_vib = document.getElementById("motor2Vibration").getContext('2d');
    var motor2TempLineChart = new Chart(ctx_live_vib, {
        type: 'line',
        data: {
            labels: labelArray,
            datasets: [{
                label: 'Vibration',
                data: [
                    35623,
                    36212,
                    36212,
                    36212
                ],
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
                        labelString: 'Time up to 15 seconds ago'
                    }
                }]
            }
        }
    });
    var ctx_live_temp = document.getElementById("motor2Temperature").getContext('2d');
    var motor2TempLineChart = new Chart(ctx_live_temp, {
        type: 'line',
        data: {
            labels: labelArray,
            datasets: [{
                label: 'Vibration',
                data: [
                    70,
                    60,
                    65,
                    80
                ],
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
                        labelString: 'Vibration Scale'
                    }
                }],

                xAxes: [{
                    ticks: {
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Time up to 15 seconds ago'
                    }
                }]
            }
        }
    }); 


    var ctx = document.getElementById("motor1Temperature").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelArray,
            datasets: [{
                label: 'Temperature of Motor',
                data: [12, 13, 4, 15, 1, 15, 15, 1, 14, 14, 1, 16, 1, 5, 15, 14, 1, 4, 3, 3, 34],
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
                borderWidth: 1,
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

    var ctx = document.getElementById("motor1Vibration").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelArray,
            datasets: [{
                label: 'Vibration of Motor',
                data: [
                    35623,
                    36212,
                    36212,
                    36212
                ],
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
                borderWidth: 1,
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