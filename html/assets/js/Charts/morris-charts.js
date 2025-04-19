
// morris charts

jQuery("#morris-line-chart").length && new Morris.Line({
    element: "morris-line-chart",
    data: [{
        year: "2008",
        value: 20
    },
    {
        year: "2009",
        value: 10
    },
    {
        year: "2010",
        value: 5
    },
    ],
    xkey: "year",
    ykeys: ["value"],
    labels: ["Value"],
    lineColors: ["#0dd6b8"]
});

if (jQuery("#morris-area-chart").length) var area = new Morris.Area({
    element: "morris-area-chart",
    resize: !0,
    data: [{
        y: "2011 Q1",
        item1: 2666,
        item2: 2666
    }, {
        y: "2011 Q2",
        item1: 2778,
        item2: 2294
    }, {
        y: "2011 Q3",
        item1: 4912,
        item2: 1969
    }, {
        y: "2011 Q4",
        item1: 3767,
        item2: 3597
    }, {
        y: "2012 Q1",
        item1: 6810,
        item2: 1914
    }, {
        y: "2012 Q2",
        item1: 5670,
        item2: 4293
    }],
    xkey: "y",
    ykeys: ["item1", "item2"],
    labels: ["Item 1", "Item 2"],
    lineColors: ["#0dd6b8", "#ff7750"],
    hoverCallback: function (e, t, a, n) {
        return ""
    }
});

jQuery("#morris-bar-chart").length && Morris.Bar({
    element: "morris-bar-chart",
    data: [{
        x: "2011 Q1",
        y: 3,
        z: 2
    }, {
        x: "2011 Q2",
        y: 2,
        z: null,
        a: 1
    }, {
        x: "2011 Q3",
        y: 0,
        z: 2,
        a: 4
    }, {
        x: "2011 Q4",
        y: 2,
        z: 4
    }],
    xkey: "x",
    ykeys: ["y", "z", "a"],
    labels: ["Y", "Z", "A"],
    barColors: ["#0dd6b8", "#1ee2ac", "#1ee2ac"],
    hoverCallback: function (e, t, a, n) {
        return ""
    }
}).on("click", function (e, t) {
    console.log(e, t)
});

if (jQuery("#morris-donut-chart").length) var donut = new Morris.Donut({
    element: "morris-donut-chart",
    resize: !0,
    colors: ["#0dd6b8", "#ff7750", "#1ee2ac"],
    data: [{
        label: "Download Sales",
        value: 30
    }, {
        label: "In-Store Sales",
        value: 12
    }, {
        label: "Mail-Order Sales",
        value: 20
    }],
    hideHover: "auto"
});




