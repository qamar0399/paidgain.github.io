(function ($) {
    "use strict";

    /**
     * Initialize the chart
     * */

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Deposits',
                data: deposit_data,
                borderWidth: 2,
                backgroundColor: 'rgba(63,82,227,.8)',
                borderColor: 'transparent',
                pointBorderWidth: 0,
                pointRadius: 3.5,
                // pointBackgroundColor: 'transparent',
                pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
            },
                {
                    label: 'Withdraws',
                    data: withdraw_data,
                    borderWidth: 2,
                    backgroundColor: 'rgba(254,86,83,.7)',
                    borderColor: 'transparent',
                    pointBorderWidth: 0 ,
                    pointRadius: 3.5,
                    // pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
                },
                {
                    label: 'Transactions',
                    data: transaction_data,
                    borderWidth: 2,
                    backgroundColor: 'rgba(255,230,0,0.7)',
                    borderColor: 'transparent',
                    pointBorderWidth: 0 ,
                    pointRadius: 3.5,
                    // pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(140,130,41,0.7)',
                }]
        },
        options: {
            legend: {
                display: true
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        // display: false,
                        drawBorder: true,
                        color: '#f2f2f2',
                    },
                    ticks: {
                        beginAtZero: true,
                        // stepSize: 5000,
                        callback: function(value, index, values) {
                            return '$' + value;
                        }
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false,
                        tickMarkLength: 15,
                    }
                }]
            },
        }
    });
})(jQuery);
