<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        .cpass {
            border: none;
            box-shadow: 1px 1px 1px 2px cyan;
            width: 800px;
            height: 400px;
            margin-top: 100px;
            background: black;
            opacity: 0.8;
            color: cyan;
            text-align: center;
        }

        .button {
            margin-bottom: 100px;
        }

        .btnSubmit {
            margin-top: 2vw;
            border-radius: 10px;
            font-size: 19px;
            padding: 0px 10px 0px 10px;
            background: lime;
            color: white;
            border: solid white;
            width: 50%;
            height: 2.6vw;
            cursor: pointer;
        }

        .cancelbtn {
            margin-top: 2vw;
            border-radius: 10px;
            font-size: 19px;
            padding: 0px 10px 0px 10px;
            background: red;
            color: white;
            border: solid white;
            width: 50%;
            height: 2.6vw;
            cursor: pointer;
        }

        .passcontent {
            margin: 20px 0;

        }


        .passcontent input {
            border: 0;
            border-bottom: 2px solid #333;
            height: 3vw;
            display: block;
            font-size: 18px;
            width: 15vw;
            transition: 0.1s ease-in;
            margin-top: 1vw;
            margin-left: 18vw;
            line-height: 1.2;
            padding: 0 2px;
            outline: none;
            border-bottom: 3px solid cyan;
            text-align: center;
            border-top: none;
            border-left: none;
            border-right: none;

        }
    </style>
</head>

<body>
    <?php session_start(); ?>
    <div style="position: absolute;background: linear-gradient(to top right, #33ccff 0%, #ff99cc 100%); width: 100%; height: 100%; top: 0; left: 0;"></div>
    <center>
        <div class="cpass" style="margin-top: 10%">
            <h1>Change Password </h1>
            </br>
            <form method="post" action="ChangePassword.php" name="cp" onsubmit="return matchpass()">
                <div class="passcontent">
                    <input class="pass" id="password" type="password" name="password" placeholder="Type Your New Password" required />
                </div>
                <div class="passcontent">
                    <input type="password" class="pass" name="confirm_password" placeholder="Retype Your New Password" id="confirm_password" required />
                    <button type="submit" class="btnSubmit" name="confirm" onclick="myfunction()">Confirm Changes</button>
                    <button type="button" class="cancelbtn" onclick="bckbtn()">Cancel</button>
                </div>
            </form>
        </div>
    </center>

    <?php if (isset($_POST['confirm'])) {
        $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
        $changepass = "UPDATE member_list SET memberPassword = '" . md5($_POST['confirm_password']) . "' WHERE memberID = '" . $_SESSION['id'] . "'";
        mysqli_query($conn, $changepass);


        if (mysqli_affected_rows($conn) <= 0) {
            echo "<script>alert('Cannot Update data!');</script>";
            die("<script>window.location.href='ChangePassword.php';</script>");
        } else {
            echo "<script>alert('Data Updated Successfully!');</script>";
            echo "<script>window.location.href='memberprofile.php';</script>";
        }
    } ?>

    <script>
        function bckbtn() {
            location.replace("memberprofile.php")
        }
    </script>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script type="text/javascript">
function matchpass(){
var firstpassword=document.cp.password.value;
var secondpassword=document.cp.confirm_password.value;

if(firstpassword==secondpassword){
return true;
}
else{
alert("password must be same!");
return false;
}
}
</script>
</body>

</html>
