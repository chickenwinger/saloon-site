<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.0/dist/aos.css">
    <link rel="stylesheet" href="product/product-all.css">
    <script>
        function goBack() {
            window.history.go(-1)
        }
    </script>
</head>

<body>

    <?php

    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');

    if (!isset($_GET['id'])) {
        $sql = "SELECT * FROM product_list ORDER BY RAND()";
    } elseif ($_GET['id'] == "makeup") {
        $sql = "SELECT * FROM product_list where productCategory like '%Makeup%'";
    } elseif ($_GET['id'] == "hairproduct") {
        $sql = "SELECT * FROM product_list where productCategory like '%hairproduct%'";
    } elseif ($_GET['id'] == "skincare") {
        $sql = "SELECT * FROM product_list where productCategory like '%skincare%'";
    }

    if (isset($_GET['id']) && $_GET['id'] == "") {
        echo "<script>alert('WARNING! Your attempt to change the URL will lead to error in displaying the data!');</script>";
        echo "<script>window.location.href='product-all.php'</script>";
    }

    $result = mysqli_query($conn, $sql);

    ?>

    <?php include("navbar-footer/navbar.php"); ?>

    <div class="sidebar" id="sidebar1">

        <a href="product-all.php" class="btn <?php if (!isset($_GET['id'])) {
                                                    echo "active";
                                                } ?>">All</a>
        <a href="product-all.php?id=makeup" class="btn <?php if (isset($_GET['id']) && $_GET['id'] == "makeup") {
                                                            echo "active";
                                                        } ?>">Makeup</a>
        <a href="product-all.php?id=hairproduct" class="btn <?php if (isset($_GET['id']) && $_GET['id'] == "hairproduct") {
                                                                echo "active";
                                                            } ?>">Hair Products</a>
        <a href="product-all.php?id=skincare" class="btn <?php if (isset($_GET['id']) && $_GET['id'] == "skincare") {
                                                                echo "active";
                                                            } ?>">Skincare</a>
    </div>
    <!-- 1 -->
    <table style="margin-left: 192px; border-spacing: 50px; width: 86.9%;">
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
                        <form action="product-page.php?productID=<?php echo $rows['productID']; ?>" method="POST">
                            <div class="content-img">
                                <img src="<?php echo $rows['productPicture']; ?>" alt="">
                            </div>
                            <div style="background: white" class="content-title">
                                <h4><?php echo $rows['productTitle']; ?></h4>
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
