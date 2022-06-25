<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylist Profile</title>
    <link rel="stylesheet" href="stylistprofile.css">
    <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>

<body>
    <?php include('StylistNavbar.php'); ?>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    $stylist = "SELECT * FROM employee_list WHERE empID = '$empID' ";
    $stylistresult = mysqli_query($conn, $stylist);
    ?>
    <!-- -----------------------------------------------Profile--------------------------------------------------- -->
    <div>
        <center>
            <h1 style="color:white;">Stylist Profile</h1>
        </center>
        <br>
        <?php $rows = mysqli_fetch_array($stylistresult); { ?>


            <div class="profile-pic">

                <img src="../<?php echo $rows['empPicture'] ?>" class="image" style="border-radius: 50%" alt="want" width="276px">

                <div class="middle">
                    <div class="text">
                        <i class="fa fa-camera" onclick="uploadon()" aria-hidden="true" style="cursor: pointer;">Change Picture</i>
                    </div>
                </div>
            </div>

            <table class="empDetails">
                <tr>
                    <td colspan="3"><i onclick="editpopup()" class="fa fa-edit" style="font-size:25px;color:black"></i></td>
                </tr>
                <tr>
                    <td class="label">Full Name:</td>
                    <td class="details"><?php echo ($rows['empFN'] . ' ' . $rows['empLN']); ?></td>
                </tr>
                <tr>
                    <td class="label">Gender:</td>
                    <td class="details"><?php echo $rows['empGender']; ?></td>
                </tr>
                <tr>
                    <td class="label">Email:</td>
                    <td class="details"><?php echo $rows['empEmail']; ?></td>
                </tr>
                <tr>
                    <td class="label">Phone Number:</td>
                    <td class="details"><?php echo $rows['empPhone']; ?></td>
                </tr>
                <tr>
                    <td class="label">Expertise:</td>
                    <td class="details"><?php echo $rows['empSkill']; ?></td>
                </tr>
                <tr>
                    <td class="label">Year Of Experience:</td>
                    <td class="details"><?php echo $rows['empYearOfExp']; ?></td>
                </tr>
                <tr>
                    <td class="label">Off Day:</td>
                    <td class="details"><?php echo $rows['empOffDay']; ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-top:10px;"><button style="height: 30px" class="change" onclick="pwdpopup()"> <span> Change Password</span></button></td>
                </tr>
            </table>

            <br>
    </div>
    <!-- ------------------------------------------------Profile end---------------------------------------------- -->
    <!-- --------------------------------------------Pop UP for Edit Profile------------------------------ -->

    <div class="edit-popup-bg">
        <form action="StylistProfile.php" method="POST">
            <table class="editpopupcontent">
                <tr>
                    <td colspan="2" style="text-align: right;height:30px;"><span class="ex" onclick="editpopupClose()">&times;</span></td>
                </tr>
                <tr>
                    <td class="leftside">First Name:</td>
                    <td class="rightside"><input type="text" name="fname" require value="<?php echo $rows['empFN'] ?>"></td>
                </tr>
                <tr>
                    <td class="leftside">Last Name:</td>
                    <td class="rightside"><input type="text" name="lname" require value="<?php echo $rows['empLN'] ?>"></td>
                </tr>
                <tr>
                    <td class="leftside">Gender:</td>
                    <td class="rightside"> <input type="text" name="gender" value="<?php echo $rows['empGender'] ?>"></td>
                </tr>
                <tr>
                    <td class="leftside">Email:</td>
                    <td class="rightside"><input type="text" name="email" require value="<?php echo $rows['empEmail'] ?>"></td>
                </tr>
                <tr>
                    <td class="leftside">Phone Number:</td>
                    <td class="rightside"><input type="text" name="ph" require value="<?php echo $rows['empPhone'] ?>"></td>
                </tr>
                <tr>
                    <td class="leftside">Expertise:</td>
                    <td class="rightside"><input type="text" name="skill" require value="<?php echo $rows['empSkill'] ?>"></td>
                </tr>
                <tr>
                    <td class="leftside">Year Of Experience:</td>
                    <td class="rightside"><input type="text" name="exp" require value="<?php echo $rows['empYearOfExp'] ?>"></td>
                </tr>
                <tr>
                    <td class="leftside">Off Day:</td>
                    <td class="rightside"><input type="text" name="off" require value="<?php echo $rows['empOffDay'] ?>"></td>
                </tr>
                <tr>

                    <td colspan="3"><button class="done" name="done" type="submit">Done</button></td>
                </tr>
            </table>
            <?php if (isset($_POST['done'])) {
                $fn = $_POST['fname'];
                $ln =  $_POST['lname'];
                $gender = $_POST['gender'];
                $email = $_POST['email'];
                $phone = $_POST['ph'];
                $skill = $_POST['skill'];
                $exp = $_POST['exp'];
                $off = $_POST['off'];

                $editemployee = "UPDATE employee_list SET empFN = '$fn', empLN ='$ln', empGender = '$gender', empEmail='$email', empPhone='$phone', empSkill ='$skill', empYearOfExp='$exp', empOffDay='$off' WHERE empID='$empID' ";
                mysqli_query($conn, $editemployee);
                if (mysqli_affected_rows($conn) <= 0) {
                    echo "<script>alert('Unable to Update!');</script>";
                    echo "<script>window.location.href='StylistProfile.php';</script>";
                } else {
                    echo "<script>alert('Data Updated Successfully!');</script>";
                    echo "<script>window.location.href='StylistProfile.php';</script>";
                }
            } ?>
        </form>

    </div>
    <!-- -------------------------------------------- EDIT POP UP End---------------------------------------------- -->
    <br>

    <!-- --------------------------------------------------Upload Picture POP UP----------------------------------------- -->
    <div class="photobg">
        <form action="StylistUploadPhoto.php" method="POST" enctype="multipart/form-data">
            <table class="upload">
                <tr>
                    <th class="lefthead">Your Current Photo</th>
                    <th class="righthead">You Can Upload New Photo by Cliking The Button Below</th>
                </tr>
                <tr>
                    <td class="leftd"><img src="../<?php echo $rows['empPicture'] ?>" style="width: 70%;height:90%;" alt=""></td>
                    <td class="rightd"><img src="#" id="newpic" alt="Upload New Photo Here"></td>
                </tr>
                <tr>
                    <td style="height: 30px;padding-top:10px;padding-bottom:10px;border-right:1px solid cyan;">&nbsp;</td>
                    <td><input type="file" require placeholder="Choose Your File" name="photo" id="photo" class="uploadphoto" required onchange="display(this)"></td>
                </tr>
                <tr>
                    <td style="padding-top: 20px;width:4vw;padding-bottom:20px" colspan="2" style="text-align:center;">
                        <button type="submit" class="confirm" name="confirmupload">Confirm</button>
                        <button type="button" class="cancel" onclick="uploadclose()">Cancel</button>
                    </td>
                </tr>
                <input type="hidden" name="empID" value="<?php echo $rows['empID'] ?>">
            </table>
        </form>
    </div>
    <!-- --------------------------------------------------Upload Picture POP UP END----------------------------------------- -->

    <!-- -------------------------------------------------- verify Password pop up----------------------------------------- -->
    <div id="id01" class="cppopup">
        <form class="cpform" action="StylistProfile.php" method="post">
            <div class="cpcontent">
                <span class="px" onclick="pwdpopupClose()">&times;</span>
                </br>
                <center><label for="psw" class="lblpsw" style="padding-top:15px;"><b>Please Type Your Current Password</b></label></br>
                    <input type="password" placeholder="Enter Password" class="psw" name="psw" required></center>

                <button type="submit" name="passconfirm" class="passconfirm">Confirm</button>
            </div>
        </form>
    </div>
    <!-- confirmpassword put here -->
    <?php if (isset($_POST['passconfirm'])) {
                $verifypassword = "SELECT * FROM employee_list WHERE empEmail = '$email' AND empPassword = '" . md5($_POST['psw']) . "'";
                $verifypassword_result = mysqli_query($conn, $verifypassword);
                if (mysqli_affected_rows($conn) <= 0) {
                    echo "<script>alert('Wrong Password! Please try again.')</script>;";
                    echo "<script>window.location.href='StylistProfile.php';</script>";
                } else {
                    echo "<script>window.location.href='StylistChangePassword.php';</script>";
                }
            }
    ?>
    </div>


    <!-- --------------------------------------------------Verify POP UP END----------------------------------------- -->

<?php  } ?>
<script>
    function editpopup() {
        document.querySelector('.edit-popup-bg').style.display = "block";
    }

    function editpopupClose() {
        document.querySelector('.edit-popup-bg').style.display = "none";

    }

    function uploadon() {
        document.querySelector('.photobg').style.display = "block";
    }

    function uploadclose() {
        document.querySelector('.photobg').style.display = "none";
    }

    function pwdpopup() {
        document.querySelector('.cppopup').style.display = "block";
    }

    function pwdpopupClose() {
        document.querySelector('.cppopup').style.display = "none";

    }

    function display(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#newpic')
                    .attr('src', e.target.result)
                    .width(276)
                    .height(276);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>

</html>
