var chart;
var dat = new Array();
var dat1 = new Array();
var chartData = [];

AmCharts.ready(function () {
  // first we generate some random data
  generateChartData();

  // SERIAL CHART
  chart = new AmCharts.AmSerialChart();
  chart.pathToImages = "images/";
  chart.dataProvider = chartData;
  chart.categoryField = "date";
  chart.plotAreaBorderColor = "#AEAEAE";
  chart.plotAreaBorderAlpha = 1;
  chart.marginLeft = 0;
  chart.marginRight = 3;
  chart.marginTop = 0;
  // AXES
  // Category
  var categoryAxis = chart.categoryAxis;
  categoryAxis.parseDates = true; // in order char to understand dates, we should set parseDates to true
  categoryAxis.minPeriod = "mm"; // as we have data with minute interval, we have to set "mm" here.
  categoryAxis.gridColor = "#cccccc";
  categoryAxis.gridAlpha = 1;
  categoryAxis.equalSpacing = true; //it is not shown unnecessary dates are removed means not having data not shown the chart
  categoryAxis.autoGridCount = false; //it is true xaxis data set
  categoryAxis.gridCount = 8;
  categoryAxis.axisColor = "#cccccc";
  categoryAxis.gridPosition = "start";
  categoryAxis.startOnAxis = false;
  categoryAxis.showFirstLabel = false;
  categoryAxis.showLastLabel = false;
  categoryAxis.centerLabelOnFullPeriod = true;
  categoryAxis.markPeriodChange = false;
  categoryAxis.fontSize = 10;
  categoryAxis.fontColor = "#000000";
  categoryAxis.dashLength = 0;
  categoryAxis.tickLength = 0;

  ////	        // Value
  var valueAxis = new AmCharts.ValueAxis();
  valueAxis.gridColor = "#cccccc";
  valueAxis.gridAlpha = 1;
  valueAxis.title = "";
  valueAxis.axisColor = "#cccccc";
  valueAxis.axisAlpha = 1;
  valueAxis.inside = true;

  chart.addValueAxis(valueAxis);

  var graph = new AmCharts.AmGraph();
  graph.type = "line"; // try to change it to "column"
  graph.valueField = "closeprice";
  graph.type = "line";
  graph.lineAlpha = 1;
  graph.lineColor = "#89bed3";
  graph.fillColor = "#89bed3";

  graph.useDataSetColors = false;
  graph.fillAlphas = 0.3;
  graph.lineThickness = 2;
  graph.numberFormatter = {
    precision: 2,
    decimalSeparator: ".",
    thousandsSeparator: ",",
  };

  var text = graph.balloonText;
  graph.balloonText = "" + graph.balloonText;

  chart.addGraph(graph);

  var graph1 = new AmCharts.AmGraph();
  graph1.type = "line"; // try to change it to "column"
  graph1.valueField = "prevClose";
  graph1.useDataSetColors = false;
  graph1.type = "line";
  graph1.lineColor = "#005cad";
  graph1.useDataSetColors = false;
  graph1.numberFormatter = {
    precision: 2,
    decimalSeparator: ".",
    thousandsSeparator: ",",
  };
  graph1.lineThickness = 2;
  graph1.fillAlphas = 0;

  var text = graph.balloonText;
  graph1.balloonText = "Prev. Close: " + graph.balloonText;

  chart.addGraph(graph1);

  // CURSOR
  var chartCursor = new AmCharts.ChartCursor();
  chartCursor.cursorPosition = "mouse";
  chartCursor.zoomable = false;
  chartCursor.categoryBalloonDateFormat = "JJ:NN, DD MMMM";
  chartCursor.cursorColor = "#89bed3";
  chartCursor.categoryBalloonColor = "#89bed3";
  chartCursor.addListener("onHideCursor", handleRollOut);
  chartCursor.addListener("changed", handleRollOver);
  chart.addChartCursor(chartCursor);

  // add cursor event on stock panel
  chart.addListener("drawn", function (event) {
    var monthNames = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    var dat = chartData[chartData.length - 1].date.split(" ");
    var dat1 = chartData[0].date.split(" ");
    document.getElementById("date").innerHTML = dat1[1] + " - " + dat[1];
    var dt = new Date(chartData[chartData.length - 1].date);

    var datTime1 =
      monthNames[dt.getMonth()] + " " + dt.getDate() + " , " + dt.getFullYear();

    document.getElementById("tdDateTime").innerHTML = "As on " + datTime1;
    document.getElementById("amChartsLegend").innerHTML = numberWithCommas(
      chartData[chartData.length - 1].closeprice
    );
  });

  // WRITE

  chart.write("chartdiv");
});

// generate some random data, quite different range
function passChartData(data) {
  var dt = data.split("#");

  for (var i = 0; i < dt.length; i++) {
    if (dt[i] != "") {
      var dtq = dt[i].split("@");
      chartData.push({
        date: dtq[0],
        closeprice: dtq[1],
        prevClose: dtq[2],
      });
    }
  }
}

function handleRollOver(event) {
  try {
    var dat = chartData[event.index].date.split(" ");

    document.getElementById("date").innerHTML = dat[1];
    document.getElementById("amChartsLegend").innerHTML = numberWithCommas(
      chartData[event.index].closeprice
    );
  } catch (e) {}
}
function numberWithCommas(x) {
  var parts = x.toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return parts.join(".");
}
function handleRollOut(event) {
  var dat = chartData[chartData.length - 1].date.split(" ");
  var dat1 = chartData[0].date.split(" ");
  document.getElementById("date").innerHTML = dat1[1] + " - " + dat[1];
  document.getElementById("amChartsLegend").innerHTML = numberWithCommas(
    chartData[chartData.length - 1].closeprice
  );
}
