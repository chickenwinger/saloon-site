<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
if (isset($_GET['btnUpdate'])) {
    $check_same_quantity = "SELECT * FROM product_order WHERE product_orderID = '" . $_GET['product_order_id'] . "' AND orderQuantity = '" . $_GET['quantity'] . "'";
    mysqli_query($conn, $check_same_quantity);

    if (mysqli_affected_rows($conn) <= 0) {
        $cart_update = "UPDATE product_order SET orderQuantity = '" . $_GET['quantity'] . "' WHERE product_orderID = '" . $_GET['product_order_id'] . "'";
        mysqli_query($conn, $cart_update);
    }
    echo ("<script>window.history.back();</script>");
} else if (isset($_GET['btnMinusQuantity'])) {
    $check_1 = "SELECT * FROM product_order WHERE orderQuantity = 1 AND product_orderID = '" . $_GET['product_order_id'] . "'";
    mysqli_query($conn, $check_1);

    if (mysqli_affected_rows($conn) <= 0) {
        $cart_update = "UPDATE product_order SET orderQuantity = (orderQuantity - 1) WHERE product_orderID = '" . $_GET['product_order_id'] . "'";
        mysqli_query($conn, $cart_update);
        echo ("<script>window.history.back();</script>");
    } else {
        $cart_remove = "DELETE FROM product_order WHERE product_orderID = '" . $_GET['product_order_id'] . "'";
        mysqli_query($conn, $cart_remove);
        echo ("<script>window.history.back();</script>");
    }
} else if (isset($_GET['btnPlusQuantity'])) {
    $cart_update = "UPDATE product_order SET orderQuantity = (orderQuantity + 1) WHERE product_orderID = '" . $_GET['product_order_id'] . "'";
    mysqli_query($conn, $cart_update);
    echo ("<script>window.history.back();</script>");
} else if (isset($_GET['btnRemove'])) {
    $cart_remove = "DELETE FROM product_order WHERE orderID = (SELECT orderID FROM order_list WHERE memberID = '" . $_SESSION['id'] . "' AND orderPrice IS NULL) AND product_orderID = '" . $_GET['product_order_id'] . "' AND orderPayment = 'pending'";
    mysqli_query($conn, $cart_remove);
    echo "<script>alert('The selected cart has been deleted!');</script>";
    echo ("<script>window.history.back();</script>");
}
?>
