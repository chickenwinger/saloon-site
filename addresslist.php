<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address List</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="MemberProfile/addresslist.css">
</head>

<body>
    <?php include('navbar-footer/navbar.php');
    if (isset($_SESSION['login'])) {
        $userid = $_SESSION['id'];
    } else {
        echo "<script>window.location.href='homepage.php';</script>";
    }
    ?>
    </br>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');

    $daddress = "Select member_address.member_addressID, member_address.defaultAddress , member_address.memberAddress from member_address JOIN member_list ON member_list.memberID WHERE member_address.memberID = '" . $_SESSION['id'] . "' AND member_address.defaultAddress = 'default' ";
    $daddressresult = mysqli_query($conn, $daddress);

    ?>


    </br>
    <?php $rows = mysqli_fetch_array($daddressresult); { ?>
        <table class="daddress">

            <td style="font-size: 30px;text-align: justify;">Default Address</td>

            <tr>
                <td> <?php echo $rows['memberAddress'] ?></td>

                <td><i style='font-size:24px' class='fas' onclick="window.location.href='editaddress.php?id=<?php echo $rows['member_addressID'] ?>'">&#xf304;</i></td>
            </tr>

        </table>
    <?php } ?>
    <div class="addaddressbg">
        <form action="addresslist.php" method="post">

            <table class="addtable">
                <tr>
                    <td style="height:2vw;"><span class="ex" onclick="addaddressbgClose()">&times;</span></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h2>New Address</h2>
                    </td>
                </tr>
                <tr>

                    <td><input name="hs_no" class="small-input" type="text" required placeholder="House/Unit No."></td>
                    <td><input name="Street" class="small-input" type="text" required placeholder="Street"></td>
                    <td><input name="Resident" class="small-input" type="text" required placeholder="Residential Name"></td>

                </tr>
                <tr>

                    <td><input name="Postal" class="small-input" type="text" required placeholder="Postal Code"></td>
                    <td><input name="City" class="small-input" type="text" required placeholder="City"></td>
                    <td>
                        <select class="small-input" name="SelectState" required>
                            <option selected disabled>-Select a state-</option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Selangor">Selangor</option>
                        </select>
                    </td>
                </tr>
                <tr>

                    <td colspan="3"><button type="submit" name="adddone" class="done">DONE</button></td>
                </tr>
            </table>

        </form>
        <?php if (isset($_POST['adddone'])) {
            $House_no = mysqli_real_escape_string($conn, $_POST['hs_no']);
            $Street = mysqli_real_escape_string($conn, $_POST['Street']);
            $Resident = mysqli_real_escape_string($conn, $_POST['Resident']);
            $Postal_code = mysqli_real_escape_string($conn, $_POST['Postal']);
            $City = mysqli_real_escape_string($conn, $_POST['City']);
            $State = mysqli_real_escape_string($conn, $_POST['SelectState']);
            $insert_newaddress = "INSERT INTO member_address (memberAddress,memberID) VALUES(CONCAT('$House_no',', ','$Street',', ','$Resident',', ','$Postal_code',', ','$City',', ','$State'), '$userid'); ";
            mysqli_query($conn, $insert_newaddress);

            //check update query working or not
            if (mysqli_affected_rows($conn) <= 0) {
                echo "<script> alert('Unable to Add! \\nPlease try Again!');";
                die("window.location.href='addresslist.php';</script>");
            } else {
                echo "<script>alert('Address added Successfully!');";
                echo "window.location.href='addresslist.php';</script>";
            }
        }
        ?>
    </div>
    <script>
        function addaddressbg() {
            document.querySelector('.addaddressbg').style.display = "block";
        }

        function addaddressbgClose() {

            document.querySelector('.addaddressbg').style.display = "none";
        }
    </script>


    </br>


    <?php


    $address = "Select DISTINCT member_address.member_addressID,  member_address.defaultAddress , member_address.memberAddress from member_address JOIN member_list ON member_list.memberID WHERE member_address.memberID = '" . $_SESSION['id'] . "' AND member_address.defaultAddress IS NULL";
    $addressresult = mysqli_query($conn, $address);
    if (mysqli_num_rows($addressresult) <= 0) {

    ?>
        <center>
            <h1 style="font-size: 30px;text-align: center;margin-top:3vw;color:#993300;padding-bottom:10px">Address List</h1>
        </center>

        <div class="ifnoaddress">
            <center>
                <h1>You have only one Address after registration.</h1>
                <img src="MemberProfile/tenor.gif" class="aquacry">
                <br>
                <h1> If you wish to add more, Please Click Here.</h1>
                </br>
                <button onclick="addaddressbg()" class="addbtn"><i class="fas fa-plus"></i>Add Address</button>
            </center>
        </div>




    <?php } else { ?>

        <h1 style="font-size: 30px;font-family: Verdana;text-align: center;margin-top:3vw;color:white;">Address List</h1>
        <div class="addresslistbg" style="border-radius: 50%;background:black;width:50px;height:40px;margin-left: 82vw;">
            <i class="fa fa-plus" onclick="addaddressbg()" style="font-size: 30px;margin-left: 0.8vw;margin-top:0.3vw;border:none;color:white;text-align: center;text-shadow: 3px 4px 5px rgba(0, 0, 0, 0.32), 1px 1px 1px pink, 1px 2px 0px pink, 1px 3px 1px pink;" aria-hidden="true"></i>
        </div>
        <?php $column = 0;
        $row = 1; ?>
        <?php while ($rows = mysqli_fetch_array($addressresult)) {
            if ($row > $column) { ?>



                <table class="addresslist">

                    <tr>
                        <td style="text-align:right;padding-left:10vw;" colspan="2">
                            <i style='font-size:24px' class='fas' onclick="window.location.href='editaddress.php?id=<?php echo $rows['member_addressID'] ?>'">&#xf304;</i>
                        </td>
                        <td style="text-align: center">
                            <i class="fas fa-trash-alt" name="deleteaddress" onclick="window.location.href='deleteaddress.php?id=<?php echo $rows['member_addressID'] ?>'" style="font-size: 24px;"></i>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            &nbsp;&nbsp;&nbsp;<?php echo $rows['memberAddress']; ?>
                        </td>

                        <td style="width:9vw;height:6vw;padding-top:3vw;padding-left:2px;">
                            <form action="addresslist.php" method="POST" style="width:100%;height:100%;">
                                <input type="hidden" value="<?php echo $rows['member_addressID']; ?>" name="Aid">
                                <button class="setdef" name="setdefault">Set Default</button>
                            </form>
                        </td>
                    </tr>
                </table>
                <?php if (isset($_POST['setdefault'])) {
                    $Aid = $_POST['Aid'];
                    $deletedefault = "UPDATE member_address SET defaultAddress = NULL WHERE defaultAddress = 'default' AND memberID = '$userid' ";
                    $deletedefaultresult = mysqli_query($conn, $deletedefault);

                    if (mysqli_affected_rows($conn) <= 0) {
                        echo "<script>alert('Unable To Clear Default!');</script>";
                        echo "<script>window.location.href='addresslist.php';</script>";
                    } else {
                        $setdefault = "UPDATE member_address SET defaultAddress ='default' WHERE member_addressID ='$Aid' AND memberID = '$userid' ";
                        $setresult = mysqli_query($conn, $setdefault);
                        if (mysqli_affected_rows($conn) <= 0) {
                            echo "<script>alert('Unable To Set Default!');</script>";
                            echo "<script>window.location.href='addresslist.php';</script>";
                        } else {
                            echo "<script>alert('Successfully !');</script>";
                            echo "<script>window.location.href='addresslist.php';</script>";
                        }
                    }
                }

                ?>

    <?php }
        }
    } ?>
    </br>
    <div style="height: 100px"></div>
    <?php include('navbar-footer/footer.php'); ?>

</body>

</html>
