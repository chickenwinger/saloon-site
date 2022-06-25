<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Revenue</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url(report-bg.png) center no-repeat fixed;
            background-size: cover;
            color: white;
        }

        #chartdiv {
            width: 97%;
            height: 600px;
        }

        #chartdiv2 {
            width: 100%;
            height: 500px;
        }
    </style>
</head>

<body>
    <?php include('admin-navbar.php'); ?>
    <h1 style="text-align: center; color: white">Total Revenue</h1>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    $sql = "SELECT SUM(outfit_list.outfitPrice * outfit_rental.rentalDuration) as TotalRental FROM outfit_list INNER JOIN outfit_rental on outfit_list.outfitID = outfit_rental.outfitID ";
    $sql2 = "SELECT SUM(product_order.orderQuantity * product_list.productPrice) as TotalProduct FROM product_list INNER JOIN product_order on product_list.productID = product_order.productID WHERE product_order.orderPayment = 'paid'";
    $sql3 = "SELECT SUM(booking_datetime.servID * service_list.servPrice) as TotalService FROM booking_datetime INNER JOIN service_list on  booking_datetime.servID = service_list.servID";
    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);
    $result3 = mysqli_query($conn, $sql3);
    $r1 = mysqli_fetch_array($result);
    $r2 = mysqli_fetch_array($result2);
    $r3 = mysqli_fetch_array($result3);
    ?>

    <!-- Resources -->
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/dark.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script> <!-- this is the bar chart -->
    <script src="https://www.amcharts.com/lib/4/themes/frozen.js"></script>

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
                <?php echo "{'country':'Outfit', visits:'" . $r1['TotalRental'] . "'}"; ?>,
                <?php echo  "{'country':'Product', visits:'" . $r2['TotalProduct'] . "'}"; ?>,
                <?php echo "{'country':'Service', visits:'" . $r3['TotalService'] . "'}"; ?>
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
            series.tooltipText = "[{categoryX}: bold]RM{valueY}[/]";
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
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_frozen);

            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv2", am4charts.PieChart);

            // Add data
            chart.data = [
                <?php
                echo
                    "{'Category': 'Rental',
                            'Quantity':'" . $r1['TotalRental'] . "'}";
                ?>,
                <?php
                echo
                    "{'Category': 'Product',
                            'Quantity':'" . $r2['TotalProduct'] . "'}";
                ?>,
                <?php
                echo
                    "{'Category': 'Service',
                            'Quantity':'" . $r3['TotalService'] . "'}";
                ?>,
            ];

            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "Quantity";
            pieSeries.dataFields.category = "Category";
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
    <h1 style="text-align: center; color: white">Total Revenue by Percentage</h1>
    <div id="chartdiv2"></div>

</body>

</html>
