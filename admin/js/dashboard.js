(function($) {
    "use strict";

    var period = $('#days').val();
    $('#days').on('change', () => {
        period = $('#days').val();
        loadData();
    });

    var base_url = $("#base_url").val();
    var site_url = $("#site_url").val();
    var dashboard_static_url = $("#dashboard_static").val();

    loadData();
    loadStaticData();
    dashboard_withdraw_statistics($('#month').val());
    load_deposit_performance(7);
    load_withdraw_performance(7);
    load_transaction_performance(7);

    $('#deposit_performance_dropdown').on('change', function() {
        var period = $(this).val();
        load_deposit_performance(period);
    });

    $('#withdraw_performance_dropdown').on('change', function() {
        var period = $(this).val();
        load_withdraw_performance(period);
    });

    $('#transaction_performance_dropdown').on('change', function() {
        var period = $(this).val();
        load_transaction_performance(period);
    });


    $('.month').on('click', function(e) {
        $('.month').removeClass('active');
        $(this).addClass("active");
        var month = e.currentTarget.dataset.month;
        $('#withdraw_month').html(month);
        dashboard_withdraw_statistics(month);
    });


     function loadData() {

        $.ajax({
            type: 'get',
            url: base_url+'/admin/dashboard/visitors/'+period,

            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,

            success: function(response){ 
                analytics_report(response.TotalVisitorsAndPageViews);
                top_browsers(response.TopBrowsers);
                Referrers(response.Referrers);
                TopPages(response.MostVisitedPages);
                $('#new_vistors').html(number_format(response.fetchUserTypes[0].sessions))
                $('#returning_visitor').html(number_format(response.fetchUserTypes[1].sessions))
            }
        })

    }


     function analytics_report(data) {
        var statistics_chart = document.getElementById("google_analytics").getContext('2d');
        var labels=[];
        var visitors=[];
        var pageViews=[];
        var total_visitors=0;
        var total_page_views=0;
        $.each(data, function(index, value){
            labels.push(value.date);
            visitors.push(value.visitors);
            pageViews.push(value.pageViews);
            var total_visitor = total_visitors+value.visitors;
            total_visitors=total_visitor;
            var total_page_view = total_page_views+value.pageViews;
            total_page_views=total_page_view;
        });

        $('#total_visitors').html(number_format(total_visitors));
        $('#total_page_views').html(number_format(total_page_views));

        var myChart = new Chart(statistics_chart, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Visitors',
                    data: visitors,
                    borderWidth: 5,
                    borderColor: '#6777ef',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6777ef',
                    pointRadius: 4
                },
                {
                    label: 'PageViews',
                    data: pageViews,
                    borderWidth: 5,
                    borderColor: '#6777ef',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6777ef',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#fbfbfb',
                            lineWidth: 2
                        }
                    }]
                },
            }
        });

    }


    function Referrers(data) {
        $('#refs').html('');
        $.each(data, function(index, value){
            var html='<div class="mb-4"> <div class="text-small float-right font-weight-bold text-muted">'+number_format(value.pageViews)+'</div><div class="font-weight-bold mb-1">'+value.url+'</div></div><hr>';

            $('#refs').append(html);
        });
    }

    function top_browsers(data) {
        $('#browsers').html('');
        $.each(data, function(index, value){
            var browser_name=value.browser;
            if (browser_name=='Edge') {
                var browser_name='internet-explorer';
            }
            var html=' <div class="col text-center"> <div class="browser browser-'+lower(browser_name)+'"></div><div class="mt-2 font-weight-bold">'+value.browser+'</div><div class="text-muted text-small"><span class="text-primary"></span> '+number_format(value.sessions)+'</div></div>';
            $('#browsers').append(html);
            if (index==4) {
                return false;
            }
        });
    }

    function TopPages(data) {
        $('#table-body').html('');
        $.each(data, function(index, value){
            var index=index+1;


            var html='<div class="mb-4"> <div class="text-small float-right font-weight-bold text-muted">'+number_format(value.pageViews)+' (Views)</div><div class="font-weight-bold mb-1"><a href="'+site_url+value.url+'" target="_blank" draggable="false">'+value.pageTitle+'</a></div></div>';
            $('#table-body').append(html);

        });
    }

    function loadStaticData() {
        $.ajax({
            type: 'get',
            url: dashboard_static_url,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,

            success: function(response) {
                $('#total_customers').html(response.total_customers);
                $('#total_deposits').html(response.total_deposits);
                $('#total_withdraws').html(response.total_withdraws);
                $('#total_subscriptions').html(response.total_subscriptions);
                $('#total_deposits_of_this_year').html(response.total_deposits_of_this_year);
                $('#total_withdraws_of_this_year').html(response.total_withdraws_of_this_year);

                var dates = [];
                var totals = [];

                $.each(response.deposits, function(index, value) {
                    var dat = value.month + ' ' + value.year;
                    var total = value.total;

                    dates.push(dat);
                    totals.push(total);
                });

                deposit_chart(dates, totals);

                var dates = [];
                var totals = [];

                $.each(response.withdraws, function(index, value) {
                    var dat = value.month + ' ' + value.year;
                    var total = value.total;

                    dates.push(dat);
                    totals.push(total);
                });

                withdraw_chart(dates, totals);
            }
        });
    }

    function dashboard_withdraw_statistics(month) {
        var url = $('#dashboard_withdraw_statistics').val();
        var gif_url = $('#gif_url').val();
        var html = "<img src=" + gif_url + ">";
        $('#pending_withdraw').html(html);
        $('#approved_withdraw').html(html);
        $('#expired_withdraw').html(html);
        $('#total_withdraw').html(html);
        $.ajax({
            type: 'get',
            url: url + '/' + month,
            dataType: 'json',


            success: function(response) {
                $('#pending_withdraw').html(response.total_pending);
                $('#approved_withdraw').html(response.total_approved);
                $('#expired_withdraw').html(response.total_expired);
                $('#total_withdraw').html(response.total_withdraws);
            }
        })
    }

    // start:: Deposit Chart //
    var deposit_chart_2d = document.getElementById("deposit_chart").getContext('2d');

    var deposit_chart_2d_bg_color = deposit_chart_2d.createLinearGradient(0, 0, 0, 70);
    deposit_chart_2d_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
    deposit_chart_2d_bg_color.addColorStop(1, 'rgba(63,82,227,0)');
    // end:: Deposit Chart //
    function deposit_chart(dates, totals) {
        var myChart = new Chart(deposit_chart_2d, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Total Amount',
                    data: totals,
                    backgroundColor: deposit_chart_2d_bg_color,
                    borderWidth: 3,
                    borderColor: 'rgba(63,82,227,1)',
                    pointBorderWidth: 0,
                    pointBorderColor: 'transparent',
                    pointRadius: 3,
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(63,82,227,1)',
                }]
            },
            options: {
                layout: {
                    padding: {
                        bottom: -1,
                        left: -1
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            beginAtZero: true,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false,
                        },
                        ticks: {
                            display: false
                        }
                    }]
                },
            }
        });

    }

    // start:: Withdraw Chart //
    var withdraw_chart_2d = document.getElementById("withdraw_chart").getContext('2d');
    var withdraw_chart_2d_bg_color = withdraw_chart_2d.createLinearGradient(0, 0, 0, 70);
    withdraw_chart_2d_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
    withdraw_chart_2d_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

    function withdraw_chart(dates, totals) {
        var myChart = new Chart(withdraw_chart_2d, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Total Amount',
                    data: totals,
                    backgroundColor: withdraw_chart_2d_bg_color,
                    borderWidth: 3,
                    borderColor: 'rgba(63,82,227,1)',
                    pointBorderWidth: 0,
                    pointBorderColor: 'transparent',
                    pointRadius: 3,
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(63,82,227,1)',
                }]
            },
            options: {
                layout: {
                    padding: {
                        bottom: -1,
                        left: -1
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            beginAtZero: true,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false,
                        },
                        ticks: {
                            display: false
                        }
                    }]
                },
            }
        });

    }
    // end:: Withdraw Chart //

    function load_deposit_performance(period) {
        $('#deposit_performance').show();
        var url = $('#dashboard_deposit_performance').val();
        $.ajax({
            type: 'get',
            url: url + '/' + period,
            dataType: 'json',

            success: function(response) {
                $('#deposit_performance').hide();
                var month_year = [];
                var dates = [];
                var totals = [];

                if (period != 365) {
                    $.each(response, function(index, value) {
                        var total = value.total;
                        var dte = value.date;
                        totals.push(total);
                        dates.push(dte);
                    });

                    load_performance_chart(dates, totals, 'deposit_performance_chart');
                } else {
                    $.each(response, function(index, value) {
                        var month = value.month;
                        var total = value.total;

                        month_year.push(month);
                        totals.push(total);
                    });
                    load_performance_chart(month_year, totals, 'deposit_performance_chart');
                }

            }
        });
    }

    function load_withdraw_performance(period) {
        $('#withdraw_performance').show();
        var url = $('#dashboard_withdraw_performance').val();
        $.ajax({
            type: 'get',
            url: url + '/' + period,
            dataType: 'json',

            success: function(response) {
                $('#withdraw_performance').hide();
                var month_year = [];
                var dates = [];
                var totals = [];

                if (period != 365) {
                    $.each(response, function(index, value) {
                        var total = value.total;
                        var dte = value.date;
                        totals.push(total);
                        dates.push(dte);
                    });

                    load_performance_chart(dates, totals, 'withdraw_performance_chart');
                } else {
                    $.each(response, function(index, value) {
                        var month = value.month;
                        var total = value.total;

                        month_year.push(month);
                        totals.push(total);
                    });
                    load_performance_chart(month_year, totals, 'withdraw_performance_chart');
                }

            }
        });
    }

    function load_transaction_performance(period) {
        $('#transaction_performance').show();
        var url = $('#dashboard_transaction_performance').val();
        $.ajax({
            type: 'get',
            url: url + '/' + period,
            dataType: 'json',

            success: function(response) {
                $('#transaction_performance').hide();
                var month_year = [];
                var dates = [];
                var totals = [];

                if (period != 365) {
                    $.each(response, function(index, value) {
                        var total = value.total;
                        var dte = value.date;
                        totals.push(total);
                        dates.push(dte);
                    });

                    load_performance_chart(dates, totals, 'transaction_performance_chart');
                } else {
                    $.each(response, function(index, value) {
                        var month = value.month;
                        var total = value.total;

                        month_year.push(month);
                        totals.push(total);
                    });
                    load_performance_chart(month_year, totals, 'transaction_performance_chart');
                }
            }
        });
    }

    // Dynamic Reusable Chart Function
    function load_performance_chart(dates, totals, id = "myChart") {
        var ctx = document.getElementById(id).getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Total Amount',
                    data: totals,
                    borderWidth: 2,
                    backgroundColor: 'rgba(63,82,227,.8)',
                    borderWidth: 0,
                    borderColor: 'transparent',
                    pointBorderWidth: 0,
                    pointRadius: 3.5,
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1500,
                            callback: function(value) {
                                return value;
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
    }

      function lower(str) {
        var str= str.toLowerCase();
        var str=str.replace(' ',str);
        return str;
    }


    function number_format(number) {
        var num= new Intl.NumberFormat( { maximumSignificantDigits: 3 }).format(number);
        return num;
    }
})(jQuery);