<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="MemberProfile/memberprofile.css">
  <title>Member Profile</title>
</head>

<body>
  <?php include('navbar-footer/navbar.php'); ?>
  </br>
  <h1 class="head" style="text-align: center;">Personal Profile</h1>
  </br>

  <?php
  if (isset($_SESSION['login'])) {

    $userid = $_SESSION['id'];
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    $member = "Select member_list.memberFN, member_list.memberLN, member_list.memberGender, member_list.memberUsername, member_list.memberPhone, member_list.memberEmail, member_list.memberID FROM member_list WHERE member_list.memberID = $userid ";
    $memberresult = mysqli_query($conn, $member);
    if (mysqli_num_rows($memberresult) <= 0) {
      echo "<script>alert('No data')</script>";
    }

  ?>

    <?php if ($rows = mysqli_fetch_array($memberresult)) { ?>

      <!--   ------------------------------------------------Pop UP for Edit Member Details------------------------------------------------------- -->
      <div class="edpopup">
        <form action="memberprofile.php" method="post">
          <div class="editcontent">

            <br>
            <table class="editdetails">
              <tr>
                <td><span class="ex" onclick="editpopupClose()">&times;</span></td>
              </tr>
              <tr>
                <th width="150px">First Name:</th>
                <td width="300px">
                  <input type="text" name="fname" value="<?php echo $rows['memberFN']; ?>" />
                </td>
              </tr>

              <tr style="height: 1vw;"> &nbsp</tr>
              <tr>
                <th width="150px">Last Name:</th>
                <td width="300px">
                  <input type="text" name="lname" value="<?php echo $rows['memberLN']; ?>" />
                </td>
              </tr>
              <tr style="height: 1vw;"> &nbsp</tr>

              <tr>
                <th width="150px">Gender:</th>
                <td width="300px">
                  <input type="text" name="gender" value="<?php echo $rows['memberGender'] ?>" />
                </td>
              </tr>
              <tr style="height: 1vw;"> &nbsp</tr>
              <tr>
                <th width="150px">UserName:</th>
                <td width="300px">
                  <input type="text" name="uname" value="<?php echo $rows['memberUsername'] ?>" />
                </td>
              </tr>
              <tr style="height: 1vw;"> &nbsp</tr>
              <tr>
                <th width="150px">Email:</th>
                <td width="300px">
                  <input type="text" name="Email" value="<?php echo $rows['memberEmail'] ?>" />
                </td>
              </tr>
              <tr style="height: 1vw;"> &nbsp</tr>
              <tr>
                <th width="150px">Phone Number:</th>
                <td width="300px">
                  <input type="text" name="phno" value="<?php echo $rows['memberPhone'] ?>" />
                </td>
              </tr>
              <tr>
                <td>&nbsp</td>
                <td><button type="submit" name="done" class="done">DONE</button></td>
              </tr>
            </table>
          </div>

        </form>
        <?php if (isset($_POST['done'])) {
          include('editdetails.php');
        } ?>

      </div>
      <!-- -------------------------------------------------------------EDIT POP UP END------------------------------------------->
      <div class="perdetails">


        <i onclick="editpopup()" class="fa fa-edit" style="font-size:30px;color:rgb(255, 153, 153)"></i>


        <!-- ----------------------------------------------------------DISPLAY PERSONAL DETAILS--------------------------------->
        </br>
        <table class="pdetails">
          <tr>
            <th width="150px">Full Name:</th>
            <td width="300px">
              <input type="text" name="fullname" value="<?php echo ($rows['memberLN'] . ' ' . $rows['memberFN']); ?>" disabled />
            </td>
          </tr>
          <tr style="height: 1vw;"> &nbsp</tr>

          <tr>
            <th width="150px">Gender:</th>
            <td width="300px">
              <input type="text" name="gender" value="<?php echo $rows['memberGender'] ?>" disabled />
            </td>
          </tr>
          <tr style="height: 1vw;"> &nbsp</tr>
          <tr>
            <th width="150px">UserName:</th>
            <td width="300px">
              <input type="text" name="uname" value="<?php echo $rows['memberUsername'] ?>" disabled />
            </td>
          </tr>
          <tr style="height: 1vw;"> &nbsp</tr>
          <tr>
            <th width="150px">Email:</th>
            <td width="300px">
              <input type="text" name="Email" value="<?php echo $rows['memberEmail'] ?>" disabled />
            </td>
          </tr>
          <tr style="height: 1vw;"> &nbsp</tr>
          <tr>
            <th width="150px">Phone Number:</th>
            <td width="300px">
              <input type="text" name="phno" value="<?php echo $rows['memberPhone'] ?>" disabled />
            </td>
          </tr>
          <tr> &nbsp</tr>
        </table>
        <button onclick="pwdpopup()" class="cp"><span>Change Password</span></button>
        <!-- -----------------------------------------------DISPLAY END------------------------------------------->

        <!-- -----------------------------------------POPUP FOR VERIFY PASSWORD ---------------------------------------------->



        <div id="id01" class="cppopup">

          <form class="cpform" action="memberprofile.php" method="post">


            <div class="cpcontent">
              <span class="px" onclick="pwdpopupClose()">&times;</span>
              </br>
              <center><label for="psw" class="lblpsw"><b>Please Type Your Current Password</b></label></br>
                <input type="password" placeholder="Enter Password" class="psw" name="psw" required></center>

              <button type="submit" name="confirm" class="confirm">Confirm</button>


            </div>
          </form>
          <!-- confirmpassword put here -->
          <?php if (isset($_POST['confirm'])) {
            $verifypassword = "SELECT * FROM member_list WHERE memberUsername = '" . $_SESSION['memberUsername'] . "' AND memberPassword = '" . md5($_POST['psw']) . "'";
            $verifypassword_result = mysqli_query($conn, $verifypassword);
            if (mysqli_affected_rows($conn) <= 0) {
              echo "<script>alert('Wrong Password! Please try again.')</script>;";
              echo "<script>window.location.href='memberprofile.php';</script>";
            } else {
              echo "<script>window.location.href='ChangePassword.php';</script>";
            }
          }
          ?>
        </div>
      <?php } ?>
      <!-- --------------------------------------------------VERIFY END------------------------------------------------------------------ -->

      <!-- ---------------------------------------------JAVASCRIPT---------------------------------------------- -->
      <script>
        function pwdpopup() {
          document.querySelector('.cppopup').style.display = "block";
        }

        function pwdpopupClose() {
          document.querySelector('.cppopup').style.display = "none";

        }

        function editpopup() {
          document.querySelector('.edpopup').style.display = "block";
        }

        function editpopupClose() {
          document.querySelector('.edpopup').style.display = "none";

        }
      </script>
      <!-- --------------------------------------------------END------------------------------------------------------------- -->
      </div>
      <!-------------------------------------------------DISPLAY DEFAULT ADDRESS---------------------------------------------  -->
      <div class="Address">

        </br>
        <?php
        $address = "Select  member_address.memberAddress from member_address JOIN member_list ON member_list.memberID WHERE member_address.memberID = $userid AND member_address.defaultAddress ='default'";
        $addressresult = mysqli_query($conn, $address);
        $rows = mysqli_fetch_array($addressresult); {
        ?>
          <table class="da">

            <tr>
              <td width="130px" style="margin-top: 1px;">Default Address</td>
              <td width="230px">
                <div style="height: 60px;border:1px solid;background: transparent;
        font-family: Poppins-Regular;text-align:left;
        font-size: 16px;
        color: #555555;
        line-height: 1.2;
        outline: none;
        border-bottom: 1px solid grey;
        border-top: none;
        border-left: none;
        border-right: none;overflow:hidden;width:100%;"><?php echo $rows['memberAddress'] ?></div>
              </td>
            </tr>
          </table>
          <button class="manage" onclick="window.location.href='addresslist.php?id=$userid'"><span>Manage Address</span></button>
        <?php } ?>
      </div>
      <!-- --------------------------------------------------------DEFAULT ADDRESS END---------------------------------------------------- -->


      <!-- -----------------------------------------------------------GUIDE BUTTON------------------------------------------------------------- -->
      <div class="UserActivity">
        <button class="AH" onclick="window.location.href='order-history.php'">Order History
          <button class="AH2"></button>
        </button>
        <button style="font-size: 17px" class="SC" onclick="window.location.href='upcoming-activity.php'">Services/Rentals
          <button class="SC2"></button>
        </button>
      </div>
      <!-- --------------------------------------------------------------BUTTON END------------------------------------------------------------- -->
      </br>

    <?php } else {
    echo "<script>window.location.href='homepage.php'</script>";
  }
    ?>

    <?php include('navbar-footer/footer.php'); ?>
</body>

</html>
