<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHECKOUT</title>
    <link rel="stylesheet" href="checkout/checkout.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600&display=swap" rel="stylesheet">
</head>

<body>
    <?php include('navbar-footer/navbar.php'); ?>
    <?php
    if (!isset($_SESSION['id'])) {
        echo "<script>alert('Please login first!');</script>";
        echo "<script>window.history.back();</script>";
    }

    if ($_POST['total'] == 0) {
        echo "<script>alert('Please select at least a cart item to pay!');</script>";
        echo "<script>window.history.back()</script>";
    }

    $member_detail = "SELECT * FROM member_list ml INNER JOIN member_address ma ON ml.memberID = ma.memberID WHERE ml.memberID = '" . $_SESSION['id'] . "'";
    $member_result = mysqli_query($conn, $member_detail);
    $row_member = mysqli_fetch_array($member_result);

    $total_cart = "SELECT * FROM product_order WHERE orderID = (SELECT orderID FROM order_list WHERE memberID = '" . $_SESSION['id'] . "' AND orderPrice IS NULL) AND orderPayment = 'pending'";
    $result_total_cart = mysqli_query($conn, $total_cart);
    $numOfCart = mysqli_num_rows($result_total_cart); //total number
    $checkboxArr = array();
    for ($i = 1; $i <= $numOfCart; $i++) {
        if (isset($_POST['checkboxID' . $i])) {
            array_push($checkboxArr, $_POST['checkboxID' . $i]);
        }
    }
    ?>

    <div style="height: 50px"></div>

    <table class="member-table">
        <tr>
            <td class="left-td">Full Name: </td>
            <td><input type="text" disabled value="<?php echo ($row_member['memberLN'] . " " . $row_member['memberFN']); ?>" name="fullname"></td>
        </tr>
        <tr>
            <td class="left-td">Email: </td>
            <td><input type="email" disabled value="<?php echo $row_member['memberEmail']; ?>" name="member_email"></td>
        </tr>
        <tr>
            <td class="left-td">Phone Number: </td>
            <td><input type="text" disabled value="<?php echo $row_member['memberPhone']; ?>" name="member_phone"></td>
        </tr>
        <tr>
            <td class="left-td">Address: </td>
            <td>
                <input type="hidden" value="<?php echo $row_member['memberAddress']; ?>" name="member_address">
                <?php echo $row_member['memberAddress']; ?>
            </td>
            <button class="btnChangeAddress" type="button" onclick="document.location.href = 'addresslist.php';">Change Default</button>
        </tr>
    </table>

    <table class="total-box">
        <tr>
            <td>Total: </td>
        </tr>
        <tr>
            <td>
                <?php if (isset($_POST['outfitID'])) { ?>
                    RM <?php echo ($_POST['total'] * $_POST['rentDuration']. " + RM ".$_POST['total'] * 2); ?>
                <?php } else { ?>
                    RM <?php echo $_POST['total']; ?>
                <?php } ?>
            </td>
        </tr>
    </table>

    <div style="height: 50px"></div>

    <form action="checkout.php" method="POST">
        <table class="checkout-table">
            <tr>
                <td colspan="2">
                    <h2 style="text-align: center">C H E C K O U T</h2>
                </td>
            </tr>
            <tr>
                <td class="left-checkout-td">NAME ON CARD: </td>
                <td><input class="checkout-inp" type="text" name="" required></td>
            </tr>
            <tr>
                <td class="left-checkout-td">CREDIT/DEBIT CARD: </td>
                <td><input class="checkout-inp" type="text" name="" required></td>
            </tr>
            <tr>
                <td class="left-checkout-td">EXPIRY MONTH: </td>
                <td><input class="checkout-inp" type="text" name="" required></td>
            </tr>
            <tr>
                <td class="left-checkout-td">EXPIRY YEAR: </td>
                <td><input class="checkout-inp" type="text" name="" required></td>
            </tr>
            <tr>
                <td class="left-checkout-td">CVV: </td>
                <td><input class="checkout-inp" type="text" name="" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php if (isset($_POST['btnCheckout'])) { ?>
                        <!-- PRODUCT DATA START -->
                        <input type="hidden" name="btnCheckout" value="<?php echo $_POST['btnCheckout']; ?>">
                        <input type="hidden" value="<?php echo $_POST['total']; ?>" name="total">
                        <input type="hidden" name="checkboxArr" value="<?php echo join(",", $checkboxArr); ?>">
                        <!-- PRODUCT DATA END -->
                    <?php } else if (isset($_POST['btnRent'])) { ?>
                        <!-- OUTFIT DATA START -->
                        <input type="hidden" name="btnRent" value="<?php echo $_POST['btnRent']; ?>">
                        <input type="hidden" name="rentSize" value="<?php echo $_POST['rentSize']; ?>">
                        <input type="hidden" name="rentDuration" value="<?php echo $_POST['rentDuration']; ?>">
                        <input type="hidden" name="rentDate" value="<?php echo $_POST['rentDate']; ?>">
                        <input type="hidden" name="outfitID" value="<?php echo $_POST['outfitID']; ?>">
                        <input type="hidden" name="total" value="<?php echo $_POST['total']; ?>">
                        <!-- OUTFIT DATA END -->
                    <?php } else if (isset($_POST['btnService'])) { ?>
                        <!-- SERVICES DATA START -->
                        <input type="hidden" name="btnService"> <!-- just to indicate btnService exist after refresh -->
                        <input type="hidden" name="input_empID" value="<?php echo $_POST['input_empID']; ?>">
                        <input type="hidden" name="notes_to_stylist" value="<?php echo $_POST['notes_to_stylist']; ?>">
                        <input type="hidden" name="dates" value="<?php echo $_POST['dates']; ?>">
                        <input type="hidden" name="timess" value="<?php echo $_POST['timess']; ?>">
                        <input type="hidden" name="servID" value="<?php echo $_POST['servID']; ?>">
                        <input type="hidden" name="total" value="<?php echo $_POST['total']; ?>">
                        <!-- SERVICES DATA END -->
                    <?php } ?>
                    <button class="btnCancel" type="button" onclick="document.location.href='cart.php'">Cancel</button>
                    <button class="btnCheckout" name="btnCheckoutFinal" type="submit">Checkout</button>
                </td>
            </tr>
        </table>
    </form>


    <div style="height: 70px"></div>
    <?php
    if (isset($_POST['btnCheckout']) && isset($_POST['btnCheckoutFinal'])) {
        $checkboxArr = explode(",", $_POST['checkboxArr']);

        foreach ($checkboxArr as $index) {
            $pay = "UPDATE product_order SET orderPayment = 'paid', orderDateTime = NOW() WHERE product_orderID = $index AND orderPayment = 'pending'";
            mysqli_query($conn, $pay);
            $deduct_product = "UPDATE product_list SET productStock = (productStock - (SELECT orderQuantity FROM product_order WHERE product_orderID = $index AND orderPayment = 'paid')) WHERE productID = (SELECT productID FROM product_order WHERE product_orderID = $index AND orderPayment = 'paid')";
            $result_deduct_product = mysqli_query($conn, $deduct_product);
        }

        $insert_price = "UPDATE order_list SET orderPrice = '" . $_POST['total'] . "' WHERE memberID = '" . $_SESSION['id'] . "' AND orderPrice IS NULL";
        mysqli_query($conn, $insert_price);

        $insert_order = "INSERT INTO order_list (memberID) VALUES (" . $_SESSION['id'] . ")";
        mysqli_query($conn, $insert_order);

        $update_pending = "UPDATE product_order SET orderID = (SELECT orderID FROM order_list WHERE orderPrice IS NULL AND memberID = '" . $_SESSION['id'] . "') WHERE orderID = (SELECT orderID FROM order_list WHERE orderPrice IS NOT NULL AND memberID = '" . $_SESSION['id'] . "' ORDER BY orderID DESC LIMIT 1) AND  orderPayment = 'pending'";
        mysqli_query($conn, $update_pending);
        echo "<script>alert('Successfully paid the orders! You will received your parcel in 7 working days. Should there be a problem, email us.');</script>";
        echo "<script>window.location.href='cart.php';</script>";
    } else if (isset($_POST['btnService']) && isset($_POST['btnCheckoutFinal'])) {
        $pay_service = "INSERT INTO booking_datetime (memberID, servID, employee_serviceID, bookingDate, bookingTime, notesToEmployee) " .
            "VALUES('" . $_SESSION['id'] . "', '" . $_POST['servID'] . "', " .
            "(SELECT emp_servID FROM employee_service WHERE empID = '" . $_POST['input_empID'] . "' AND servID = '" . $_POST['servID'] . "'), " .
            "'" . $_POST['dates'] . "', '" . $_POST['timess'] . "', '" . $_POST['notes_to_stylist'] . "')";
        mysqli_query($conn, $pay_service);
        echo "<script>alert('Successfully paid! Now please wait for your stylist to accept your booking');</script>";
        echo "<script>window.location.href='upcoming-activity.php';</script>";
    } else if (isset($_POST['btnRent']) && isset($_POST['btnCheckoutFinal'])) {
        $pay_rent = "INSERT INTO outfit_rental (memberID, outfitID, outfit_sizeID, rentalDate, rentalDuration) " .
            "VALUES('" . $_SESSION['id'] . "', '" . $_POST['outfitID'] . "', " .
            "(SELECT outfit_sizeID FROM outfit_size WHERE outfitID = '" . $_POST['outfitID'] . "' AND outfitSize = '" . $_POST['rentSize'] . "'), " .
            "'" . $_POST['rentDate'] . "', '" . $_POST['rentDuration'] . "')";
        mysqli_query($conn, $pay_rent);
        $deduct_outfit = "UPDATE outfit_size SET outfitstock = (outfitstock - 1) WHERE outfitID = '" . $_POST['outfitID'] . "' AND outfitSize = '" . $_POST['rentSize'] . "'";
        mysqli_query($conn, $deduct_outfit);
        echo "<script>alert('Successfully paid! Please pick up your outfit ONE day before rental date');</script>";
        echo "<script>window.location.href='upcoming-activity.php';</script>";
    }
    ?>
    <?php include('navbar-footer/footer.php'); ?>
</body>

</html>
