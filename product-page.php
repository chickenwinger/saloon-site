<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="product/product-page.css">
</head>

<body style="background: url(homepage/home-bg.jpg) no-repeat center fixed; background-size: cover;">
    <?php include("navbar-footer/navbar.php"); ?>

    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');

    $id = $_GET['productID'];
    $sql = "SELECT * FROM product_list WHERE productID = $id";
    $result = mysqli_query($conn, $sql);

    if (!isset($_GET['productID']) || $_GET['productID'] == "") {
        echo "<script>alert('WARNING! Your attempt to change the URL will lead to error in displaying the data!');</script>";
        echo "<script>window.history.go(-1);</script>";
    }

    ?>

    <div style="position: absolute; margin-left: 20px; margin-top: 20px;">
        <?php $rows = mysqli_fetch_array($result) ?>
        <p>
            <a href="product-all.php" style="color: black;">
                <i class="fa fa-arrow-circle-left" style="font-size:48px; cursor:pointer"></i>
            </a>
        </p>
    </div>

    <form action="product-page.php?productID=<?php echo $_GET['productID']; ?>" method="POST">
        <table class="table1">
            <input type="hidden" name="input_productID" value="<?php echo $_GET['productID']; ?>">
            <tr>
                <td rowspan="8" class="product-img">
                    <a>
                        <img src="<?php echo $rows['productPicture'] ?>" height="100%" style="border: solid 3px black;">
                    </a>
                </td>
            </tr>
            <tr>
                <td class="content1"><b><?php echo $rows['productTitle'] ?></b></td>
            </tr>
            <tr>
                <td class="content2"><b><?php echo $rows['productContent'] ?></b></td>
            </tr>
            <tr>
                <td class="content2"><i><?php echo $rows['productDescription'] ?></i></td>
            </tr>
            <tr>
                <td class="content3">RM<?php echo $rows['productPrice'] ?> per item</td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <a>
                        Quantity:
                        <input name="order_quantity" type="number" min="1" max="<?php echo $rows['productStock'] ?>" value="1">
                        (Stock = <?php echo $rows['productStock'] ?>)
                    </a>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <b><button class="button" type="submit" name="btnCart">ADD TO CART</button></b>
                </td>
            </tr>
        </table>
    </form>
    <?php
    if (isset($_POST['btnCart'])) {
        $check_order = "SELECT orderID FROM order_list WHERE memberID = " . $_SESSION['id'] . " AND orderPrice IS NULL";
        $result1 = mysqli_query($conn, $check_order);
        $row1 = mysqli_fetch_array($result1);

        if (mysqli_affected_rows($conn) > 0) {
            $check_product_order = "SELECT * FROM product_order WHERE orderID = " . $row1['orderID'] . " AND productID = " . $_POST['input_productID'] . "";
            $result2 = mysqli_query($conn, $check_product_order);
            $row2 = mysqli_fetch_array($result2);

            if (mysqli_affected_rows($conn) > 0) {
                $sql_update = "UPDATE product_order SET orderQuantity = (orderQuantity + " . $_POST['order_quantity'] . ") WHERE orderID = " . $row2['orderID'] . " AND productID = " . $row2['productID'] . "";
                mysqli_query($conn, $sql_update);
            } else {
                $sql_insert = "INSERT INTO product_order (orderID, productID, orderQuantity) VALUES (" . $row1['orderID'] . ", " . $_POST['input_productID'] . ", " . $_POST['order_quantity'] . ")";
                mysqli_query($conn, $sql_insert);
            }
        } else {
            $insert_order = "INSERT INTO order_list (memberID) VALUES (" . $_SESSION['id'] . ")";
            $result3 = mysqli_query($conn, $insert_order);
            $row3 = mysqli_fetch_array($result3);

            if (mysqli_affected_rows($conn) > 0) {
                $sql_insert = "INSERT INTO product_order (orderID, productID, orderQuantity) VALUES ((SELECT orderID FROM order_list WHERE memberID = " . $_SESSION['id'] . " AND orderPrice IS NULL), " . $_POST['input_productID'] . ", " . $_POST['order_quantity'] . ")";
                mysqli_query($conn, $sql_insert);
            }
        }
        echo "<script>alert('Successfully added to cart!');</script>";
    }
    ?>

    <?php include("navbar-footer/footer.php") ?>

</body>

</html>
