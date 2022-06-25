<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Services</title>
    <link rel="stylesheet" href="service/service-all.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.0/dist/aos.css">
    <script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
</head>

<body style="background: url(homepage/home-bg.jpg) center fixed; background-size: cover;">

    <?php include("navbar-footer/navbar.php") ?>

    <?php

    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    if (!isset($_GET['id'])) {
        $sql = "SELECT * FROM service_list ORDER BY RAND()";
    } elseif ($_GET['id'] == "makeup") {
        $sql = "SELECT * FROM service_list where servCategory like '%Makeup%'";
    } elseif ($_GET['id'] == "hair") {
        $sql = "SELECT * FROM service_list where servCategory like '%Hair Styling%'";
    } elseif ($_GET['id'] == "design") {
        $sql = "SELECT * FROM service_list where servCategory like '%Design%'";
    } elseif ($_GET['id'] == "all") {
        $sql = "SELECT * FROM service_list where servCategory like '%All%'";
    }

    if (isset($_GET['id']) && $_GET['id'] == "") {
        echo "<script>alert('WARNING! Your attempt to change the URL will lead to error in displaying the data!');</script>";
        echo "<script>window.location.href='service-all.php'</script>";
    }

    $result = mysqli_query($conn, $sql);

    ?>

    <div class="sidebar" id="sidebar1">
        <a href="service-all.php" class="btn <?php if (!isset($_GET['id'])) {
                                                    echo "active";
                                                } ?>">All</a>

        <a href="service-all.php?id=makeup" class="btn <?php if (isset($_GET['id']) && $_GET['id'] == "makeup") {
                                                            echo "active";
                                                        } ?>">Makeup Service</a>

        <a href="service-all.php?id=hair" class="btn <?php if (isset($_GET['id']) && $_GET['id'] == "hair") {
                                                            echo "active";
                                                        } ?>">Hair Styling Service</a>

        <a href="service-all.php?id=design" class="btn <?php if (isset($_GET['id']) && $_GET['id'] == "design") {
                                                            echo "active";
                                                        } ?>">Custom Outfit Design</a>
    </div>
    <!-- 1 -->
    <table style="margin-left: 200px; border-spacing: 50px; width: 86.9%;">
        <tr>

            <?php
            $column = 1;
            $row = 4;
            while ($rows = mysqli_fetch_array($result)) {
                if ($row < $column) {
                    echo "</tr><tr>";
                    $row += 4;
                } ?>
                <td class="content-td">
                    <div class="box-shadow" data-aos="fade-up">
                        <form action="service-page.php?servID=<?php echo $rows['servID']; ?>" method="POST">
                            <div class="content-img">
                                <img src="<?php echo $rows['servPicture']; ?>" alt="">
                            </div>
                            <div style="background: white" class="content-title">
                                <h4><?php echo $rows['servTitle']; ?></h4>
                            </div>
                            <button type="submit" class="content-btn"></button>
                        </form>
                    </div>
                    <script>
                        AOS.init({
                            duration: 1000,
                        })
                    </script>
                </td>
            <?php
                $column += 1;
            }
            ?>
        </tr>
    </table>

    <?php include("navbar-footer/footer.php"); ?>

</body>

</html>
