<?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    $addID = $_GET['id'];


    $deleteaddress = "DELETE FROM `member_address` WHERE member_address.member_addressID = '$addID' AND member_address.defaultAddress IS NULL ";
    $deleteaddressresult = mysqli_query($conn, $deleteaddress);
    if (mysqli_affected_rows($conn) <= 0) {
        echo "<script>alert('Unable To Delete Address!');</script>";
        /* echo "<script>window.location.href='addresslist.php';</script>"; */
    } else {
        echo "<script>alert('Deleted Successfully !');</script>";
        echo "<script>window.location.href='addresslist.php';</script>";
    }?>
