<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMCHART ROUND</title>
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }
    </style>


</head>

<body>
    <?php include('navbar-footer/navbar.php'); ?>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    $sql = "SELECT * FROM product_list";
    $result = mysqli_query($conn, $sql);
    ?>
    <!-- Resources -->
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/frozen.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

    <!-- Chart code -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_frozen);
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv", am4charts.PieChart);

            // Add data
            chart.data = [
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "{'country': '" . $row['productTitle'] . "','litres': '" . $row['productPrice'] . "'},";
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
</body>

</html>
