<!--   Core JS Files   -->
<script src="{{ asset('assets/dashboard/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('assets/dashboard/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('assets/dashboard/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('assets/dashboard/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('assets/dashboard/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('assets/dashboard/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('assets/dashboard/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('assets/dashboard/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/plugin/jsvectormap/world.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('assets/dashboard/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Kaiadmin JS -->
<script src="{{ asset('assets/dashboard/js/kaiadmin.min.js') }}"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{ asset('assets/dashboard/js/setting-demo.js') }}"></script>
{{-- <script src="{{ asset('assets/dashboard/js/demo.js') }}"></script> --}}

<script>
    // Cicle Chart
    Circles.create({
        id: 'task-complete',
        radius: 50,
        value: 80,
        maxValue: 100,
        width: 5,
        text: function(value) {
            return value + '%';
        },
        colors: ['#36a3f7', '#fff'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    if (window.location.href.includes('/dashboard')) {
        $.notify({
            icon: 'icon-bell',
            title: 'Welcome!!',
            message: '{{ Auth::user()->name }}',
        }, {
            type: 'secondary',
            placement: {
                from: "bottom",
                align: "right"
            },
            time: 1000,
        });
    }

    // Jsvectormap
    var world_map = new jsVectorMap({
        selector: "#world-map",
        map: "world",
        zoomOnScroll: false,
        regionStyle: {
            hover: {
                fill: '#435ebe'
            }
        },
        markers: [{
                name: 'Indonesia',
                coords: [-6.229728, 106.6894311],
                style: {
                    fill: '#435ebe'
                }
            },
            {
                name: 'United States',
                coords: [38.8936708, -77.1546604],
                style: {
                    fill: '#28ab55'
                }
            },
            {
                name: 'Russia',
                coords: [55.5807481, 36.825129],
                style: {
                    fill: '#f3616d'
                }
            },
            {
                name: 'China',
                coords: [39.9385466, 116.1172735]
            },
            {
                name: 'United Kingdom',
                coords: [51.5285582, -0.2416812]
            },
            {
                name: 'India',
                coords: [26.8851417, 75.6504721]
            },
            {
                name: 'Australia',
                coords: [-35.2813046, 149.124822]
            },
            {
                name: 'Brazil',
                coords: [-22.9140693, -43.5860681]
            },
            {
                name: 'Egypt',
                coords: [26.834955, 26.3823725]
            },
        ],
        onRegionTooltipShow(event, tooltip) {
            tooltip.css({
                backgroundColor: '#435ebe'
            })
        }
    });

    //Chart

    var ctx = document.getElementById('statisticsChart').getContext('2d');

    var statisticsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Subscribers",
                borderColor: '#f3545d',
                pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
                pointRadius: 0,
                backgroundColor: 'rgba(243, 84, 93, 0.4)',
                legendColor: '#f3545d',
                fill: true,
                borderWidth: 2,
                data: [154, 184, 175, 203, 210, 231, 240, 278, 252, 312, 320, 374]
            }, {
                label: "New Visitors",
                borderColor: '#fdaf4b',
                pointBackgroundColor: 'rgba(253, 175, 75, 0.6)',
                pointRadius: 0,
                backgroundColor: 'rgba(253, 175, 75, 0.4)',
                legendColor: '#fdaf4b',
                fill: true,
                borderWidth: 2,
                data: [256, 230, 245, 287, 240, 250, 230, 295, 331, 431, 456, 521]
            }, {
                label: "Active Users",
                borderColor: '#177dff',
                pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
                pointRadius: 0,
                backgroundColor: 'rgba(23, 125, 255, 0.4)',
                legendColor: '#177dff',
                fill: true,
                borderWidth: 2,
                data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                bodySpacing: 4,
                mode: "nearest",
                intersect: 0,
                position: "nearest",
                xPadding: 10,
                yPadding: 10,
                caretPadding: 10
            },
            layout: {
                padding: {
                    left: 5,
                    right: 5,
                    top: 15,
                    bottom: 15
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        fontStyle: "500",
                        beginAtZero: false,
                        maxTicksLimit: 5,
                        padding: 10
                    },
                    gridLines: {
                        drawTicks: false,
                        display: false
                    }
                }],
                xAxes: [{
                    gridLines: {
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: 10,
                        fontStyle: "500"
                    }
                }]
            },
            legendCallback: function(chart) {
                var text = [];
                text.push('<ul class="' + chart.id + '-legend html-legend">');
                for (var i = 0; i < chart.data.datasets.length; i++) {
                    text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor +
                        '"></span>');
                    if (chart.data.datasets[i].label) {
                        text.push(chart.data.datasets[i].label);
                    }
                    text.push('</li>');
                }
                text.push('</ul>');
                return text.join('');
            }
        }
    });

    var myLegendContainer = document.getElementById("myChartLegend");

    // generate HTML legend
    myLegendContainer.innerHTML = statisticsChart.generateLegend();

    // bind onClick event to all LI-tags of the legend
    var legendItems = myLegendContainer.getElementsByTagName('li');
    for (var i = 0; i < legendItems.length; i += 1) {
        legendItems[i].addEventListener("click", legendClickCallback, false);
    }

    var dailySalesChart = document.getElementById('dailySalesChart').getContext('2d');

    var myDailySalesChart = new Chart(dailySalesChart, {
        type: 'line',
        data: {
            labels: ["January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September"
            ],
            datasets: [{
                label: "Sales Analytics",
                fill: !0,
                backgroundColor: "rgba(255,255,255,0.2)",
                borderColor: "#fff",
                borderCapStyle: "butt",
                borderDash: [],
                borderDashOffset: 0,
                pointBorderColor: "#fff",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "#fff",
                pointHoverBorderWidth: 1,
                pointRadius: 1,
                pointHitRadius: 5,
                data: [65, 59, 80, 81, 56, 55, 40, 35, 30]
            }]
        },
        options: {
            maintainAspectRatio: !1,
            legend: {
                display: !1
            },
            animation: {
                easing: "easeInOutBack"
            },
            scales: {
                yAxes: [{
                    display: !1,
                    ticks: {
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold",
                        beginAtZero: !0,
                        maxTicksLimit: 10,
                        padding: 0
                    },
                    gridLines: {
                        drawTicks: !1,
                        display: !1
                    }
                }],
                xAxes: [{
                    display: !1,
                    gridLines: {
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: -20,
                        fontColor: "rgba(255,255,255,0.2)",
                        fontStyle: "bold"
                    }
                }]
            }
        }
    });

    $("#activeUsersChart").sparkline([112, 109, 120, 107, 110, 85, 87, 90, 102, 109, 120, 99, 110, 85, 87, 94], {
        type: 'bar',
        height: '100',
        barWidth: 9,
        barSpacing: 10,
        barColor: 'rgba(255,255,255,.3)'
    });
</script>

<script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
    });
</script>

<script>
    $(document).ready(function() {
        $("#basic-datatables").DataTable({});

        // $("#multi-filter-select").DataTable({
        //     pageLength: 5,
        //     initComplete: function() {
        //         this.api()
        //             .columns()
        //             .every(function() {
        //                 var column = this;
        //                 var select = $(
        //                         '<select class="form-select"><option value=""></option></select>'
        //                     )
        //                     .appendTo($(column.footer()).empty())
        //                     .on("change", function() {
        //                         var val = $.fn.dataTable.util.escapeRegex($(this).val());

        //                         column
        //                             .search(val ? "^" + val + "$" : "", true, false)
        //                             .draw();
        //                     });

        //                 column
        //                     .data()
        //                     .unique()
        //                     .sort()
        //                     .each(function(d, j) {
        //                         select.append(
        //                             '<option value="' + d + '">' + d + "</option>"
        //                         );
        //                     });
        //             });
        //     },
        // });

        // // Add Row
        // $("#add-row").DataTable({
        //     pageLength: 5,
        // });

        // var action =
        //     '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        // $("#addRowButton").click(function() {
        //     $("#add-row")
        //         .dataTable()
        //         .fnAddData([
        //             $("#addName").val(),
        //             $("#addPosition").val(),
        //             $("#addOffice").val(),
        //             action,
        //         ]);
        //     $("#addRowModal").modal("hide");
        // });
    });
</script>
