<?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');

    if (isset($_POST['btnReg'])) {
        $member_ln = mysqli_real_escape_string($conn, $_POST['ln']);
        $member_fn = mysqli_real_escape_string($conn, $_POST['fn']);
        $member_username = mysqli_real_escape_string($conn, $_POST['username']);
        $member_gender = mysqli_real_escape_string($conn, $_POST['regGender']);
        $member_email = mysqli_real_escape_string($conn, $_POST['email']);
        $member_phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $member_password = mysqli_real_escape_string($conn, $_POST['password']);
        $member_confirmpassword = mysqli_real_escape_string($conn, $_POST['cfm-password']);
        $house_no = mysqli_real_escape_string($conn, $_POST['hs-no']);
        $street = mysqli_real_escape_string($conn, $_POST['street']);
        $resident = mysqli_real_escape_string($conn, $_POST['resident']);
        $postal_code = mysqli_real_escape_string($conn, $_POST['postal']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $state = mysqli_real_escape_string($conn, $_POST['selectState']);


        //check pwd = cfm pwd
        if ($member_password !== $member_confirmpassword) {
            echo "<script>alert('Password and confirm password not matched!');";
            die("window.history.back();</script>");
        }

        //insert member info
        $insert_member = "INSERT INTO member_list (memberFN, memberLN, memberGender, memberUsername, memberEmail, memberPhone, memberPassword)".
        "VALUES ('$member_fn', '$member_ln', '$member_gender', '$member_username', '$member_email', $member_phone, '" . md5($member_confirmpassword) . "'); ";
        mysqli_query($conn, $insert_member);
        //insert member address
        $insert_address = "INSERT INTO member_address (memberID, memberAddress, defaultAddress)".
        "VALUES (LAST_INSERT_ID(), CONCAT('$house_no',', ','$street',', ','$resident',', ','$postal_code',', ','$city',', ','$state'), 'default');";
        mysqli_query($conn, $insert_address);

        //check update query working or not
        if (mysqli_affected_rows($conn) <= 0) {
            echo "<script> alert('Unable to register! \\nPlease try Again!');";
            die("window.history.back();</script>");
        } else {
            echo "<script>alert('Register successfully! Login now!');";
            echo "window.location.href='../homepage.php';</script>";
        }
    }
?>
