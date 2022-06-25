<?php


   
    $fn = $_POST['fname'];
    $ln = $_POST['lname'];
    $gender = $_POST['gender'];
    $uname = $_POST['uname'];
    $email = $_POST['Email'];
    $phno = $_POST['phno'];

    $sql = "Update member_list SET memberFN ='$fn', memberLN ='$ln', memberGender ='$gender', memberUsername ='$uname', memberEmail ='$email', memberPhone ='$phno' WHERE memberID = '" . $_SESSION['id'] . "' ";
    mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) <= 0) {
    echo "<script>alert('Cannot Update data!');</script>";
    die("<script>window.location.href='memberprofile.php';</script>");
} else {
    echo "<script>alert('Data Updated Successfully!');</script>";
    echo "<script>window.location.href='memberprofile.php';</script>";
}
?>