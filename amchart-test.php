<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMCHART</title>
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }

        #chartdiv2 {
            width: 100%;
            height: 500px;
        }
    </style>
</head>

<body bgcolor="grey">
    <?php include('navbar-footer/navbar.php'); ?>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    $sql = "SELECT *, (pl.productPrice * po.orderQuantity) AS subtotal FROM product_list pl INNER JOIN product_order po " .
        "ON pl.productID = po.productID INNER JOIN order_list ol " .
        "ON ol.orderID = po.orderID  WHERE " .
        "po.orderPayment = 'pending'";
    $result = mysqli_query($conn, $sql);
    ?>

    <!-- Resources -->
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script> <!-- this is the bar chart -->
    <script src="https://www.amcharts.com/lib/4/themes/frozen.js"></script> <!-- pie chart -->

    <!-- Chart code -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv", am4charts.XYChart);
            chart.scrollbarX = new am4core.Scrollbar();
            chart.data = [
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "{'country':'" . $row['productTitle'] . "','visits': '" . $row['productPrice'] . "'},";
                }
                ?>
            ];

            // Create axes
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "country";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;
            categoryAxis.renderer.labels.template.horizontalCenter = "right";
            categoryAxis.renderer.labels.template.verticalCenter = "middle";
            categoryAxis.renderer.labels.template.rotation = 270;
            categoryAxis.tooltip.disabled = true;
            categoryAxis.renderer.minHeight = 110;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.minWidth = 50;

            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.sequencedInterpolation = true;
            series.dataFields.valueY = "visits";
            series.dataFields.categoryX = "country";
            series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
            series.columns.template.strokeWidth = 0;

            series.tooltip.pointerOrientation = "vertical";

            series.columns.template.column.cornerRadiusTopLeft = 10;
            series.columns.template.column.cornerRadiusTopRight = 10;
            series.columns.template.column.fillOpacity = 0.8;

            // on hover, make corner radiuses bigger
            var hoverState = series.columns.template.column.states.create("hover");
            hoverState.properties.cornerRadiusTopLeft = 0;
            hoverState.properties.cornerRadiusTopRight = 0;
            hoverState.properties.fillOpacity = 1;

            series.columns.template.adapter.add("fill", function(fill, target) {
                return chart.colors.getIndex(target.dataItem.index);
            });

            // Cursor
            chart.cursor = new am4charts.XYCursor();

        }); // end am4core.ready()
    </script>
    <script>
        <?php
        $sql2 = "SELECT * FROM product_list";
        $result2 = mysqli_query($conn, $sql2);
        ?>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_frozen);
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv2", am4charts.PieChart);

            // Add data
            chart.data = [
                <?php
                while ($row2 = mysqli_fetch_array($result2)) {
                    echo "{'country': '" . $row2['productTitle'] . "','litres': '" . $row2['productPrice'] . "'},";
                }
                ?>
            ];

            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "litres";
            pieSeries.dataFields.category = "country";
            pieSeries.slices.template.stroke = am4core.color("#fff");
            pieSeries.slices.template.strokeWidth = 2;
            pieSeries.slices.template.strokeOpacity = 1;

            // This creates initial animation
            pieSeries.hiddenState.properties.opacity = 1;
            pieSeries.hiddenState.properties.endAngle = -90;
            pieSeries.hiddenState.properties.startAngle = -90;

        }); // end am4core.ready()
    </script>

    <!-- HTML -->
    <div id="chartdiv"></div>
    <br>
    <div id="chartdiv2"></div>

</body>

</html>
