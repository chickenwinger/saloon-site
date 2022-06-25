<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outfit Report</title>
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
            height: 500px;
        }

        #chartdiv2 {
            width: 100%;
            height: 500px;
        }
    </style>
</head>

<body>
    <?php include('admin-navbar.php'); ?>
    <br>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    $sql = "SELECT outfit_list.outfitTitle AS outfitTitle,(outfit_list.outfitPrice * outfit_rental.rentalDuration) AS Total,COUNT(outfit_rental.outfitID) AS Quantity FROM outfit_rental INNER JOIN outfit_list ON outfit_rental.outfitID = outfit_list.outfitID GROUP BY outfit_rental.outfitID";
    $result = mysqli_query($conn, $sql);
    ?>

    <!-- Resources -->
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/dark.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script> <!-- this is the bar chart -->
    <script src="https://www.amcharts.com/lib/4/themes/frozen.js"></script> <!-- pie chart -->

    <!-- Chart code -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_dark);
            am4core.useTheme(am4themes_animated);
            // Themes end
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            // Create chart instance


            chart.data = [
                <?php while ($row = mysqli_fetch_array($result)) {
                    echo "{'year':'" . $row['outfitTitle'] . "','income':" . $row['Total'] . ",'Quantity':" . $row['Quantity'] . "},";
                }
                ?>
            ];

            var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "year";
            categoryAxis.renderer.inversed = true;
            categoryAxis.renderer.grid.template.location = 0;

            //create value axis for income and expenses
            var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.opposite = true;


            //create columns
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.categoryY = "year";
            series.dataFields.valueX = "income";
            series.name = "Income";
            series.columns.template.fillOpacity = 0.5;
            series.columns.template.strokeOpacity = 0;
            series.tooltipText = "Income Of {categoryY}: RM{valueX.value}";

            //create line
            var lineSeries = chart.series.push(new am4charts.LineSeries());
            lineSeries.dataFields.categoryY = "year";
            lineSeries.dataFields.valueX = "Quantity";
            lineSeries.name = "Quantity";
            lineSeries.strokeWidth = 3;
            lineSeries.tooltipText = "Quantity Of {categoryY}: {valueX.value}";

            //add bullets
            var circleBullet = lineSeries.bullets.push(new am4charts.CircleBullet());
            circleBullet.circle.fill = am4core.color("#fff");
            circleBullet.circle.strokeWidth = 2;

            //add chart cursor
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.behavior = "zoomY";

            //add legend
            chart.legend = new am4charts.Legend();
        }); // end am4core.ready()
    </script>



    <script>
        <?php
        $sql2 = "SELECT *, COUNT(outfit_rental.outfitID) AS totalQuantity FROM outfit_rental INNER JOIN outfit_list ON outfit_rental.outfitID = outfit_list.outfitID GROUP BY outfit_list.outfitCategory
        ";
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
                    echo "{'country': '" . $row2['outfitCategory'] . "','litres': '" . $row2['totalQuantity'] . "'},";
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
    <h1 style="text-align: center; color: white">Outfit Revenue</h1>
    <div id="chartdiv"></div>
    <br>
    <h1 style="text-align: center; color: white">Outfit Revenue by Category Percentage</h1>
    <div id="chartdiv2"></div>

</body>

</html>
