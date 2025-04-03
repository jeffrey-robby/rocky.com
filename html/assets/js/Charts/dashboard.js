if (jQuery('#iq-sale-chart').length) {
    var options = {
        series: [{
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63]
        }],
        chart: {
            type: 'bar'
        },
        colors: ['#0dd6b8'],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '45%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['s', 'm', 't', 'w', 't', 'f', 's'],
        },
        yaxis: {
            title: {
                text: ''
            },
            labels: {
                offsetX: -20,
                offsetY: 0
            },
        },
        grid: {
            padding: {
                left: -5,
                right: 0
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#iq-sale-chart"), options);
    chart.render();
}



// ----- Wave Chart ----- //

var lastDate = 0,
    data = [],
    TICKINTERVAL = 864e5;
let XAXISRANGE = 7776e5;

function getDayWiseTimeSeries(e, t, a) {
    for (var n = 0; n < t;) {
        var o = e,
            r = Math.floor(Math.random() * (a.max - a.min + 1)) + a.min;
        data.push({
            x: o,
            y: r
        }), lastDate = e, e += TICKINTERVAL, n++
    }
}

function getNewSeries(e, t) {
    var a = e + TICKINTERVAL;
    lastDate = a;
    for (var n = 0; n < data.length - 10; n++) data[n].x = a - XAXISRANGE - TICKINTERVAL, data[n].y = 0;
    data.push({
        x: a,
        y: Math.floor(Math.random() * (t.max - t.min + 1)) + t.min
    })
}

function resetData() {
    data = data.slice(data.length - 10, data.length)
}
getDayWiseTimeSeries(new Date("11 Feb 2017 GMT").getTime(), 10, {
    min: 10,
    max: 90
});
options = {
    chart: {
        height: 150,
        type: "area",
        animations: {
            enabled: !0,
            easing: "linear",
            dynamicAnimation: {
                speed: 1e3
            }
        },
        toolbar: {
            show: !1
        },
        sparkline: {
            enabled: !0
        },
        group: "sparklines"
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        curve: "straight",
        width: 3
    },
    series: [{
        data: data
    }],
    markers: {
        size: 4
    },
    xaxis: {
        type: "datetime",
        range: XAXISRANGE
    },
    yaxis: {
        max: 100
    },
    fill: {
        type: "gradient",
        gradient: {
            shadeIntensity: 1,
            inverseColors: !1,
            opacityFrom: .5,
            opacityTo: 0,
            stops: [0, 90, 100]
        }
    },
    legend: {
        show: !1
    },
    colors: ["#0dd6b8"]
};
if (jQuery("#wave-chart-7").length) {
    options.markers.size = 0, options.chart.type = "area", options.stroke.curve = "smooth", options.chart.height = 70;
    var wave_chart_7 = new ApexCharts(document.querySelector("#wave-chart-7"), options);
    wave_chart_7.render()
}
if (jQuery("#chart-7").length) {
    var chart_7 = new ApexCharts(document.querySelector("#chart-7"), options);
    chart_7.render()
}
(jQuery("#wave-chart-7").length) && window.setInterval(function () {
    getNewSeries(lastDate, {
        min: 10,
        max: 90
    }), jQuery("#wave-chart-7").length && wave_chart_7.updateSeries([{
        data: data
    }])
}, 1e3);


