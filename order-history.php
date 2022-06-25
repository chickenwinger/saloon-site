<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="order-history.css">
    <title>Order History</title>
</head>

<body>
    <?php include('navbar-footer/navbar.php'); ?>
    <div style="height: 50px"></div>
    <h1 style="text-align: center">Activity History</h1>
    <div style="height: 50px"></div>
    <form action="" method="POST">
        <table class="select-table">
            <tr>
                <td>Category: </td>
                <td style="width: 30px"></td>
                <td>
                    <select class="select-select" name="category" id="" required>
                        <option value="" selected disabled>---Select a category---</option>
                        <option value="Products">Products</option>
                        <option value="Services">Services</option>
                        <option value="OutfitRentals">Outfit Rentals</option>
                    </select>
                </td>
                <td style="width: 50px"></td>
                <td>
                    <button class="btnSelect" type="submit">Confirm</button>
                </td>
            </tr>
        </table>
    </form>
    <div style="height: 50px"></div>
    <?php if (isset($_POST['category']) && $_POST['category'] == 'Services') { ?>
        <section><!-- services -->
            <?php
            $select_stylist = "SELECT * FROM member_address ma INNER JOIN member_list ml ON ma.memberID = ml.memberID INNER JOIN booking_datetime bd ON ml.memberID = bd.memberID INNER JOIN employee_service es ON bd.employee_serviceID = es.emp_servID INNER JOIN employee_list el ON es.empID = el.empID INNER JOIN service_list sl ON es.servID = sl.servID WHERE bd.bookingStatus != 'pending' AND bd.memberID = '" . $_SESSION['id'] . "' AND ma.defaultAddress = 'default' AND bd.bookingDate < CURDATE() ORDER BY bd.bookingID DESC LIMIT 10";
            $result_select_stylist = mysqli_query($conn, $select_stylist);
            while ($row_select_stylist = mysqli_fetch_array($result_select_stylist)) {
            ?>
                <table class="cart-table">
                    <tr>
                        <td rowspan="99" style="width: auto; padding: 11px 30px 5px 12px;">
                            <table>
                                <tr>
                                    <td style="width: 180px; height: 180px;">
                                        <img src="<?php echo $row_select_stylist['empPicture']; ?>" width="100%" height="100%" alt="">
                                        <a href="service-page.php?servID=<?php echo $row_select_stylist['servID']; ?>" class="view-product-btn">
                                            <div>V I E W <br> S E R V I C E</div>
                                        </a> <!-- product-page link -->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 18px;" colspan="4" style="padding-right: 30px; height: 70px">
                            <?php echo $row_select_stylist['servTitle']; ?>
                        </td>
                        <?php if ($row_select_stylist['bookingStatus'] == 'declined') { ?>
                            <button type="button" disabled class="appointment-status"><?php echo $row_select_stylist['bookingStatus']; ?></button>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td colspan="5">
                            Stylist: <?php echo ($row_select_stylist['empLN'] . " " . $row_select_stylist['empFN']); ?>
                        </td>
                    </tr>
                    <?php if ($row_select_stylist['bookingStatus'] != 'declined') { ?>
                    <tr>
                        <td colspan="5">
                            Date of Service: <?php echo $row_select_stylist['bookingDate']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            Time: <?php echo $row_select_stylist['bookingTime']; ?> - <?php echo $row_select_stylist['bookingTime'] + 200; ?> (24 hours system)
                        </td>
                    </tr>
                    <tr>
                        <td class="cart-table-word">
                            RM <?php echo $row_select_stylist['servPrice']; ?>
                        </td>
                    </tr>
                    <?php } else { ?>
                        <tr>
                            <td>Reasons: <?php echo $row_select_stylist['notesToMember']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <div style="height: 20px"></div>
            <?php } ?>
        </section>
    <?php } else if (isset($_POST['category']) && $_POST['category'] == 'OutfitRentals') { ?>
        <section><!-- outfit -->
            <?php
            $select_outfit = "SELECT *, DATE_ADD(ore.rentalDate, INTERVAL ore.rentalDuration DAY) AS finish_date  FROM outfit_size os INNER JOIN outfit_rental ore ON os.outfit_sizeID = ore.outfit_sizeID INNER JOIN outfit_list ol ON ore.outfitID = ol.outfitID WHERE ore.memberID = '" . $_SESSION['id'] . "' AND ore.depositStatus != 'on-hold' AND ore.outfitReturn = 'returned' AND CURDATE() > DATE_ADD(ore.rentalDate, INTERVAL ore.rentalDuration DAY) ORDER BY ore.outfitID DESC LIMIT 10";
            $result_select_outfit = mysqli_query($conn, $select_outfit);
            while ($row_select_outfit = mysqli_fetch_array($result_select_outfit)) {
            ?>
                <table class="cart-table">
                    <tr>
                        <td rowspan="99" style="width: auto; padding: 11px 30px 5px 12px;">
                            <table>
                                <tr>
                                    <td style="width: 180px; height: 180px;">
                                        <img src="<?php echo $row_select_outfit['outfitPicture']; ?>" width="100%" height="100%" alt="">
                                        <a href="outfit-page.php?outfitID=<?php echo $row_select_outfit['outfitID']; ?>" class="view-product-btn">
                                            <div>V I E W <br> O U T F I T</div>
                                        </a> <!-- product-page link -->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 18px;" colspan="3" style="padding-right: 30px; height: 70px">
                            <?php echo $row_select_outfit['outfitTitle']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Date: <?php echo ($row_select_outfit['rentalDate'] . " - " . $row_select_outfit['finish_date']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Rental Duration: <?php echo $row_select_outfit['rentalDuration']; ?> Day(s)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Outfit Size: <?php echo $row_select_outfit['outfitSize']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart-table-word">
                            RM <?php echo ($row_select_outfit['outfitPrice'] * $row_select_outfit['rentalDuration']); ?>
                        </td>
                    </tr>
                </table>
                <div style="height: 20px"></div>
            <?php } ?>
        </section>
    <?php } else { ?>
        <section><!-- products -->
            <?php
            $order_history = "SELECT * FROM product_list pl INNER JOIN product_order po ON pl.productID = po.productID INNER JOIN order_list ol ON po.orderID = ol.orderID WHERE po.orderPayment = 'paid' AND ol.memberID = '" . $_SESSION['id'] . "' AND ol.orderPrice IS NOT NULL ORDER BY po.orderDateTime DESC LIMIT 10";
            $result_order_history = mysqli_query($conn, $order_history);
            while ($row_order_history = mysqli_fetch_array($result_order_history)) {
            ?>
                <table class="cart-table">
                    <tr>
                        <td rowspan="99" style="width: auto; padding: 11px 30px 5px 12px;">
                            <table>
                                <tr>
                                    <td style="width: 180px; height: 180px;">
                                        <img src="<?php echo $row_order_history['productPicture']; ?>" width="100%" height="100%" alt="">
                                        <a href="product-page.php?productID=<?php echo $row_order_history['productID']; ?>" class="view-product-btn">
                                            <div>V I E W <br> P R O D U C T</div>
                                        </a> <!-- product-page link -->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 18px;" colspan="3" style="padding-right: 30px; height: 70px">
                            <?php echo $row_order_history['productTitle']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Date of Purchase: <?php echo $row_order_history['orderDateTime']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Quantity: <?php echo $row_order_history['orderQuantity']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="cart-table-word">
                            RM <?php echo $row_order_history['productPrice']; ?>
                        </td>
                    </tr>
                </table>
                <div style="height: 20px"></div>
            <?php } ?>
        </section>
    <?php } ?>

    <div style="height: 110px"></div>

    <?php include('navbar-footer/footer.php'); ?>
</body>

</html>
