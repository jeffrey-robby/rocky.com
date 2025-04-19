
//high chart
if ($("#high-basicline-chart").length && !Highcharts.charts[$("#high-basicline-chart").data('highchartsChart')]) {
  
    Highcharts.chart("high-basicline-chart", {
        chart: {
            type: "spline",
            inverted: true
        },
        title: {
            text: "Atmosphere Temperature by Altitude"
        },
        subtitle: {
            text: "According to the Standard Atmosphere Model"
        },
        xAxis: {
            reversed: false,
            title: {
                enabled: true,
                text: "Altitude"
            },
            labels: {
                format: "{value} km"
            },
            maxPadding: 0.05,
            showLastLabel: true
        },
        yAxis: {
            title: {
                text: "Temperature"
            },
            labels: {
                format: "{value}°"
            },
            lineWidth: 2
        },
        legend: {
            enabled: false
        },
        tooltip: {
            headerFormat: "<b>{series.name}</b><br/>",
            pointFormat: "{point.x} km: {point.y}°C"
        },
        plotOptions: {
            spline: {
                marker: {
                    enabled: false
                }
            }
        },
        series: [{
            name: "Temperature",
            color: "#0dd6b8",
            data: [
                [0, 15],
                [10, -50],
                [20, -56.5],
                [30, -46.5],
                [40, -22.1],
                [50, -2.5],
                [60, -27.7],
                [70, -55.7],
                [80, -76.5]
            ]
        }]
    });
}


jQuery("#high-area-chart").length && Highcharts.chart("high-area-chart", {
    chart: {
        type: "areaspline"
    },
    title: {
        text: "Average fruit consumption during one week"
    },
    legend: {
        layout: "vertical",
        align: "left",
        verticalAlign: "top",
        x: 150,
        y: 100,
        floating: !0,
        borderWidth: 1,
        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || "#FFFFFF"
    },
    xAxis: {
        categories: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
        plotBands: [{
            from: 4.5,
            to: 6.5,
            color: "rgba(68, 170, 213, .2)"
        }]
    },
    yAxis: {
        title: {
            text: "Fruit units"
        }
    },
    tooltip: {
        shared: !0,
        valueSuffix: " units"
    },
    credits: {
        enabled: !1
    },
    plotOptions: {
        areaspline: {
            fillOpacity: .5
        }
    },
    series: [{
        name: "John",
        color: "#0dd6b8",
        data: [3, 4, 3, 5, 4, 10, 12]
    }, {
        name: "Jane",
        color: "#1ee2ac",
        data: [1, 3, 4, 3, 3, 5, 4]
    }]
})


jQuery("#high-columnndbar-chart").length && Highcharts.chart("high-columnndbar-chart", {
    chart: {
        type: "bar"
    },
    title: {
        text: "Stacked bar chart"
    },
    xAxis: {
        categories: ["Apples", "Oranges", "Pears", "Grapes", "Bananas"]
    },
    yAxis: {
        min: 0,
        title: {
            text: "Total fruit consumption"
        }
    },
    legend: {
        reversed: !0
    },
    plotOptions: {
        series: {
            stacking: "normal"
        }
    },
    series: [{
        name: "John",
        color: "#0dd6b8",
        data: [5, 3, 4, 7, 2]
    }, {
        name: "Jane",
        color: "#ff7750",
        data: [2, 2, 3, 2, 1]
    }, {
        name: "Joe",
        color: "#1ee2ac",
        data: [3, 4, 4, 2, 5]
    }]
})

jQuery("#high-pie-chart").length && Highcharts.chart("high-pie-chart", {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: !1,
        type: "pie"
    },
    colorAxis: {},
    title: {
        text: "Browser market shares in January, 2018"
    },
    tooltip: {
        pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>"
    },
    plotOptions: {
        pie: {
            allowPointSelect: !0,
            cursor: "pointer",
            dataLabels: {
                enabled: !0,
                format: "<b>{point.name}</b>: {point.percentage:.1f} %"
            }
        }
    },
    series: [{
        name: "Brands",
        colorByPoint: !0,
        data: [{
            name: "Chrome",
            y: 61.41,
            sliced: !0,
            selected: !0,
            color: "#0dd6b8"
        }, {
            name: "Internet Explorer",
            y: 11.84,
            color: "#ff7750"
        }, {
            name: "Firefox",
            y: 10.85,
            color: "#65f9b3"
        }, {
            name: "Edge",
            y: 4.67,
            color: "#6ce6f4"
        }, {
            name: "Other",
            y: 2.61
        }]
    }]
})
jQuery("#high-dynamic-chart").length && Highcharts.chart("high-dynamic-chart", {
    chart: {
        type: "spline",
        animation: Highcharts.svg,
        marginRight: 10,
        events: {
            load: function() {
                var e = this.series[0];
                setInterval(function() {
                    var t = (new Date).getTime(),
                        a = Math.random();
                    e.addPoint([t, a], !0, !0)
                }, 1e3)
            }
        }
    },
    time: {
        useUTC: !1
    },
    title: {
        text: "Live random data"
    },
    accessibility: {
        announceNewData: {
            enabled: !0,
            minAnnounceInterval: 15e3,
            announcementFormatter: function(e, t, a) {
                return !!a && "New point added. Value: " + a.y
            }
        }
    },
    xAxis: {
        type: "datetime",
        tickPixelInterval: 150
    },
    yAxis: {
        title: {
            text: "Value"
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: "#808080"
        }]
    },
    tooltip: {
        headerFormat: "<b>{series.name}</b><br/>",
        pointFormat: "{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}"
    },
    legend: {
        enabled: !1
    },
    exporting: {
        enabled: !1
    },
    series: [{
        name: "Random data",
        color: "#0dd6b8",
        data: function() {
            var e, t = [],
                a = (new Date).getTime();
            for (e = -19; e <= 0; e += 1) t.push({
                x: a + 1e3 * e,
                y: Math.random()
            });
            return t
        }()
    }]
})
// Check if the element exists and if Highcharts chart has already been initialized
if ($("#high-gauges-chart").length && !Highcharts.charts[$("#high-gauges-chart").data('highchartsChart')]) {
    // Initialize the Highcharts gauge chart
    Highcharts.chart("high-gauges-chart", {
        chart: {
            type: "gauge",
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: "Speedometer"
        },
        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, "#FFF"],
                        [1, "#333"]
                    ]
                },
                borderWidth: 0,
                outerRadius: "109%"
            }, {
                backgroundColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, "#333"],
                        [1, "#FFF"]
                    ]
                },
                borderWidth: 1,
                outerRadius: "107%"
            }, {}, {
                backgroundColor: "#DDD",
                borderWidth: 0,
                outerRadius: "105%",
                innerRadius: "103%"
            }]
        },
        yAxis: {
            min: 0,
            max: 200,
            minorTickInterval: "auto",
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: "inside",
            minorTickColor: "#666",
            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: "inside",
            tickLength: 10,
            tickColor: "#666",
            labels: {
                step: 2,
                rotation: "auto"
            },
            title: {
                text: "km/h"
            },
            plotBands: [{
                from: 0,
                to: 120,
                color: "#55BF3B"
            }, {
                from: 120,
                to: 160,
                color: "#DDDF0D"
            }, {
                from: 160,
                to: 200,
                color: "#DF5353"
            }]
        },
        series: [{
            name: "Speed",
            data: [80],
            tooltip: {
                valueSuffix: " km/h"
            }
        }]
    }, function(chart) {
        if (!chart.renderer.forExport) {
            // Update chart data periodically
            setInterval(function() {
                var point = chart.series[0].points[0];
                var newValue = Math.round(20 * (Math.random() - 0.5));
                if ((point.y + newValue) < 0 || (point.y + newValue) > 200) {
                    newValue = -newValue;
                }
                point.update(point.y + newValue);
            }, 3000);
        }
    });
}

jQuery("#high-scatterplot-chart").length && Highcharts.chart("high-scatterplot-chart", {
    chart: {
        type: "scatter",
        zoomType: "xy"
    },
    accessibility: {
        description: "A scatter plot compares the height and weight of 507 individuals by gender. Height in centimeters is plotted on the X-axis and weight in kilograms is plotted on the Y-axis. The chart is interactive, and each data point can be hovered over to expose the height and weight data for each individual. The scatter plot is fairly evenly divided by gender with females dominating the left-hand side of the chart and males dominating the right-hand side. The height data for females ranges from 147.2 to 182.9 centimeters with the greatest concentration between 160 and 165 centimeters. The weight data for females ranges from 42 to 105.2 kilograms with the greatest concentration at around 60 kilograms. The height data for males ranges from 157.2 to 198.1 centimeters with the greatest concentration between 175 and 180 centimeters. The weight data for males ranges from 53.9 to 116.4 kilograms with the greatest concentration at around 80 kilograms."
    },
    title: {
        text: "Height Versus Weight of 507 Individuals by Gender"
    },
    subtitle: {
        text: "Source: Heinz  2003"
    },
    xAxis: {
        title: {
            enabled: !0,
            text: "Height (cm)"
        },
        startOnTick: !0,
        endOnTick: !0,
        showLastLabel: !0
    },
    yAxis: {
        title: {
            text: "Weight (kg)"
        }
    },
    legend: {
        layout: "vertical",
        align: "left",
        verticalAlign: "top",
        x: 100,
        y: 70,
        floating: !0,
        backgroundColor: Highcharts.defaultOptions.chart.backgroundColor,
        borderWidth: 1
    },
    plotOptions: {
        scatter: {
            marker: {
                radius: 5,
                states: {
                    hover: {
                        enabled: !0,
                        lineColor: "rgb(100,100,100)"
                    }
                }
            },
            states: {
                hover: {
                    marker: {
                        enabled: !1
                    }
                }
            },
            tooltip: {
                headerFormat: "<b>{series.name}</b><br>",
                pointFormat: "{point.x} cm, {point.y} kg"
            }
        }
    },
    series: [{
        name: "Female",
        color: "rgba(223, 83, 83, .5)",
        data: [
            [161.2, 51.6],
            [167.5, 59],
            [159.5, 49.2],
            [157, 63],
            [155.8, 53.6],
            [170, 59],
            [159.1, 47.6],
            [166, 69.8],
            [176.2, 66.8],
            [160.2, 75.2],
            [172.7, 62],
            [155, 49.2],
            [156.5, 67.2],
            [164, 53.8],
            [160.9, 54.4]
        ],
        color: "#0dd6b8"
    }, {
        name: "Male",
        color: "rgba(119, 152, 191, .5)",
        data: [
            [174, 65.6],
            [175.3, 71.8],
            [193.5, 80.7],
            [186.5, 72.6],
            [187.2, 78.8],
            [181.5, 74.8],
            [184, 86.4],
            [184.5, 78.4],
            [175, 62],
            [184, 81.6],
            [180.1, 93],
            [175.5, 80.9],
            [180.6, 72.7],
            [184.4, 68],
            [175.5, 70.9],
            [180.3, 83.2],
            [180.3, 83.2]
        ],
        color: "#ff7750"
    }]
})

jQuery("#high-linendcolumn-chart").length && Highcharts.chart("high-linendcolumn-chart", {
    chart: {
        zoomType: "xy"
    },
    title: {
        text: "Average Monthly Temperature and Rainfall in Tokyo"
    },
    subtitle: {
        text: "Source: WorldClimate.com"
    },
    xAxis: [{
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        crosshair: !0
    }],
    yAxis: [{
        labels: {
            format: "{value}°C",
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: "Temperature",
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, {
        title: {
            text: "Rainfall",
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: "{value} mm",
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: !0
    }],
    tooltip: {
        shared: !0
    },
    legend: {
        layout: "vertical",
        align: "left",
        x: 120,
        verticalAlign: "top",
        y: 100,
        floating: !0,
        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || "rgba(255,255,255,0.25)"
    },
    series: [{
        name: "Rainfall",
        type: "column",
        yAxis: 1,
        data: [49.9, 71.5, 106.4, 129.2, 144, 176, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
        color: "#0dd6b8",
        tooltip: {
            valueSuffix: " mm"
        }
    }, {
        name: "Temperature",
        type: "spline",
        data: [7, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
        color: "#ff7750",
        tooltip: {
            valueSuffix: "°C"
        }
    }]
})

/*---------------------------------------------------------------------
   high-3d-chart
-----------------------------------------------------------------------*/
jQuery("#high-3d-chart").length; {
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: "high-3d-chart",
            type: "column",
            options3d: {
                enabled: !0,
                alpha: 15,
                beta: 15,
                depth: 50,
                viewDistance: 25
            }
        },
        title: {
            text: "Chart rotation demo"
        },
        subtitle: {
            text: "Test options by dragging the sliders below"
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        series: [{
            data: [29.9, 71.5, 106.4, 129.2, 144, 176, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
            color: "#0dd6b8"
        }]
    });

    function showValues() {
        $("#alpha-value").html(chart.options.chart.options3d.alpha), $("#beta-value").html(chart.options.chart.options3d.beta), $("#depth-value").html(chart.options.chart.options3d.depth)
    }
    $("#sliders input").on("input change", function () {
        chart.options.chart.options3d[this.id] = parseFloat(this.value), showValues(), chart.redraw(!1)
    }), showValues()
}
/*---------------------------------------------------------------------
   high-barwithnagative-chart
-----------------------------------------------------------------------*/
jQuery("#high-barwithnagative-chart").length; {
    var categories = ["0-4", "5-9", "10-14", "15-19", "20-24", "25-29", "30-34", "35-39", "40-44", "45-49", "50-54", "55-59", "60-64", "65-69", "70-74", "75-79", "80-84", "85-89", "90-94", "95-99", "100 + "];
    Highcharts.chart("high-barwithnagative-chart", {
        chart: {
            type: "bar"
        },
        title: {
            text: "Population pyramid for Germany, 2018"
        },
        subtitle: {
            text: 'Source: <a href="http://populationpyramid.net/germany/2018/">Population Pyramids of the World from 1950 to 2100</a>'
        },
        accessibility: {
            point: {
                descriptionFormatter: function (e) {
                    return e.index + 1 + ", Age " + e.category + ", " + Math.abs(e.y) + "%. " + e.series.name + "."
                }
            }
        },
        xAxis: [{
            categories: categories,
            reversed: !1,
            labels: {
                step: 1
            },
            accessibility: {
                description: "Age (male)"
            }
        }, {
            opposite: !0,
            reversed: !1,
            categories: categories,
            linkedTo: 0,
            labels: {
                step: 1
            },
            accessibility: {
                description: "Age (female)"
            }
        }],
        yAxis: {
            title: {
                text: null
            },
            labels: {
                formatter: function () {
                    return Math.abs(this.value) + "%"
                }
            },
            accessibility: {
                description: "Percentage population",
                rangeDescription: "Range: 0 to 5%"
            }
        },
        plotOptions: {
            series: {
                stacking: "normal"
            }
        },
        tooltip: {
            formatter: function () {
                return "<b>" + this.series.name + ", age " + this.point.category + "</b><br/>Population: " + Highcharts.numberFormat(Math.abs(this.point.y), 1) + "%"
            }
        },
        series: [{
            name: "Male",
            data: [-2.2, -2.1, -2.2, -2.4, -2.7, -3, -3.3, -3.2, -2.9, -3.5, -4.4, -4.1, -0],
            color: "#0dd6b8"
        }, {
            name: "Female",
            data: [2.1, 2, 2.1, 2.3, 2.6, 2.9, 3.2, 3.1, 2.9, 3.4, 0],
            color: "#ff7750"
        }]
    })
}
