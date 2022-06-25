<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="cart/cart.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <?php include('navbar-footer/navbar.php'); ?>

    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    $display_cart = "SELECT *, (pl.productPrice * po.orderQuantity) AS subtotal FROM product_list pl INNER JOIN product_order po " .
        "ON pl.productID = po.productID INNER JOIN order_list ol " .
        "ON ol.orderID = po.orderID  WHERE " .
        "ol.memberID = '" . $_SESSION['id'] . "' AND po.orderPayment = 'pending'";
    $result_display = mysqli_query($conn, $display_cart);
    $total = 0;

    if (isset($_SESSION['login'])) {
        if (mysqli_affected_rows($conn) > 0) {
    ?>
            <form action="checkout.php" method="POST" name="cart_form" id="cart_form">
                <div style="height: 50px"></div>
                <div class="cart-total-container">
                    <div class="cart-total">
                        <h2>Total Price:</h2> <br>
                        RM<h2 id="totalRM"></h2> <br>
                        <h5>*Price included with shipping fees</h5>
                    </div>
                    <div style="height: 10px"></div>
                    <input type="hidden" name="total" id="input_total">
                    <button type="submit" id="btnCheckout" name="btnCheckout" class="btnCheckout">CHECKOUT</button>
                </div>

                <?php
                $checkbox = 0;
                while ($row_cart = mysqli_fetch_array($result_display)) {
                    $total += $row_cart['subtotal'];
                    $checkbox += 1;
                ?>
                    <table class="cart-table">
                        <tr>
                            <td rowspan="5" style="width: auto; padding: 11px 30px 5px 12px;">
                                <table>
                                    <tr>
                                        <td style="width: 47px">
                                            <label class="checkbox-label">
                                                <input class="normal-checkbox" name="checkboxID<?php echo $checkbox; ?>" id="checkboxID" data-price="<?php echo $row_cart['subtotal']; ?>" type="checkbox" value="<?php echo $row_cart['product_orderID']; ?>">
                                                <span class="custom-checkbox"></span>
                                            </label>
                                        </td>
                                        <td style="width: 180px; height: 180px;">
                                            <img src="<?php echo $row_cart['productPicture']; ?>" width="100%" height="100%" alt="">
                                            <a href="product-page.php?productID=<?php echo $row_cart['productID']; ?>" class="view-product-btn">
                                                <div>V I E W <br> P R O D U C T</div>
                                            </a> <!-- product-page link -->
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="cart-table-word" colspan="3" style="padding-right: 30px; height: 70px">
                                <input type="hidden" name="input_productID" value="<?php echo $row_cart['productID']; ?>">
                                <input type="hidden" name="input_product_orderID" id="input_product_orderID" value="<?php echo $row_cart['product_orderID']; ?>">
                                <?php echo $row_cart['productTitle']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <button type="button" class="update-quantity" name="btnMinusQuantity" id="btnMinusQuantity<?php echo $checkbox; ?>">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input type="number" min="1" max="<?php echo $row_cart['productStock']; ?>" value="<?php echo $row_cart['orderQuantity']; ?>" name="input_orderQuantity<?php echo $checkbox; ?>" id="input_orderQuantity<?php echo $checkbox; ?>">
                                <button type="button" class="update-quantity" name="btnPlusQuantity" id="btnPlusQuantity<?php echo $checkbox; ?>">
                                    <i class=" fa fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="cart-table-word">
                                RM <?php echo $row_cart['subtotal']; ?>
                                <input type="hidden" value="<?php echo $row_cart['productPrice']; ?>" id="input_productPrice">
                            </td>
                            <td rowspan="2" style="text-align: right">
                                <button type="button" name="btnUpdate" class="update-btn" id="btnUpdate<?php echo $checkbox; ?>">UPDATE</button>
                            </td>
                            <td rowspan="2" style="text-align: right; padding-right: 30px">
                                <button type="button" class="remove-btn" onclick="openDel<?php echo $row_cart['product_orderID'] ?>();">REMOVE</button>
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 10px">&nbsp;</td>
                        </tr>
                    </table>
                    <div class="cfm-del-bg" id="cfm-del-bg<?php echo $row_cart['product_orderID'] ?>">
                        <div class="del-popup-close" onclick="closeDel<?php echo $row_cart['product_orderID'] ?>()"></div>
                        <div class="del-popup">
                            <h3>Are you sure you want to delete this product?</h3>
                            <div style="height: 10px"></div>
                            <button type="button" class="btnCancel" onclick="closeDel<?php echo $row_cart['product_orderID'] ?>()">Cancel</button>
                            <button type="button" name="btnRemove" class="btnCfmDel" id="btnRemove<?php echo $checkbox; ?>">Confirm</button>
                        </div>
                    </div>

                    <script>
                        function openDel<?php echo $row_cart['product_orderID'] ?>() {
                            document.querySelector("#cfm-del-bg<?php echo $row_cart['product_orderID'] ?>").style.display = "block";
                        }

                        function closeDel<?php echo $row_cart['product_orderID'] ?>() {
                            document.querySelector("#cfm-del-bg<?php echo $row_cart['product_orderID'] ?>").style.display = "none";
                        }

                        $('#btnUpdate<?php echo $checkbox; ?>').click(function() {
                            var $quantity = document.querySelector('#input_orderQuantity<?php echo $checkbox; ?>').value;
                            $('#cart_form').attr('action', 'cart/cart-update.php?quantity=' + $quantity + '&product_order_id=<?php echo $row_cart['product_orderID']; ?>&btnUpdate=1');
                            $('#cart_form').submit();
                        });
                        $('#btnPlusQuantity<?php echo $checkbox; ?>').click(function() {
                            var $quantity = document.querySelector('#input_orderQuantity<?php echo $checkbox; ?>').value;
                            $('#cart_form').attr('action', 'cart/cart-update.php?quantity=' + $quantity + '&product_order_id=<?php echo $row_cart['product_orderID']; ?>&btnPlusQuantity=1');
                            $('#cart_form').submit();
                        });
                        $('#btnMinusQuantity<?php echo $checkbox; ?>').click(function() {
                            var $quantity = document.querySelector('#input_orderQuantity<?php echo $checkbox; ?>').value;
                            $('#cart_form').attr('action', 'cart/cart-update.php?quantity=' + $quantity + '&product_order_id=<?php echo $row_cart['product_orderID']; ?>&btnMinusQuantity=1');
                            $('#cart_form').submit();
                        });
                        $('#btnRemove<?php echo $checkbox; ?>').click(function() {
                            var $quantity = document.querySelector('#input_orderQuantity<?php echo $checkbox; ?>').value;
                            $('#cart_form').attr('action', 'cart/cart-update.php?product_order_id=<?php echo $row_cart['product_orderID']; ?>&btnRemove=1');
                            $('#cart_form').submit();
                        });
                    </script>
                    <div style="height: 50px"></div>
                <?php } ?>
                <!-- while loop end -->
            </form>

        <?php } else { ?>
            <div class="no-cart">
                <div style="width: 330px; height: 150px; margin: 0 auto; background: rgba(0, 0, 0, 0.5)">
                    <h1>There is no item in your cart. Find your desired products
                        <a href="product-all.php">here</a>.
                    </h1>
                </div>
            </div>
        <?php }
    } else { ?>

        <div class="sign-in-prompt">
            <h1 style="margin-top: 23%">Please sign in your account to view your cart!</h1>
        </div>

    <?php
        echo "<script>alert('Please sign in your account first!');</script>";
        echo "<script>loginPopup();</script>";

        if (isset($_POST['btnLogin'])) {
            echo "<script>window.location.href='cart.php';</script>";
        }
    }
    ?>

    <script>
        function calctotal() {
            var total = 0;
            $("#checkboxID:checked").each(function() {
                var price = $(this).attr("data-price");
                total += parseFloat(price);
            });
            $('#totalRM').text(total.toFixed(0));
            $('#input_total').val(total.toFixed(0));
        }
        $(function() {
            $(document).on("change", "#checkboxID", calctotal);
            $(document).on("checked", "#checkboxID", calctotal);
            calctotal();
        });
    </script>
    <div style="height: 100px"></div>
    <?php include("navbar-footer/footer.php"); ?>
</body>

</html>
