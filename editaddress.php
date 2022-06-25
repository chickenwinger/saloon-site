<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Edit Address</title>
    <style>
        body {
            background: url(MemberProfile/member-bg.png) center fixed no-repeat;
            background-size: cover;
        }

        .editdone, .editdone2 {
            margin-top: 2vw;
            border-radius: 10px;
            font-size: 25px;
            font-weight: bold;
            padding: 0px 10px 0px 10px;
            color: lime;
            border: solid lime;
            width: 60%;
            height: 2.6vw;
            cursor: pointer;
        }

        .editdone2 {
            color: red;
            border: solid red;
        }

        .editdone:hover {
            background: lime;
            color: white;
            border: solid white;
        }

        .editdone2:hover {
            background: red;
            color: white;
            border: solid white;
        }


        textarea {
            height: 90px;
            border: 1px solid;
            background: black;
            font-family: Poppins-Regular;
            text-align: justify;
            font-size: 16px;
            color: cyan;
            line-height: 1.2;
            outline: none;
            border-bottom: 1px solid cyan;
            border-top: 1px solid cyan;
            border-left: 1px solid cyan;
            border-right: 1px solid cyan;
            width: 30vw;
            opacity: 1;
            resize: none;
        }

        textarea:focus {
            background: white;
            opacity: 1;
            color: black;
            border-bottom: 3px solid cyan;
        }

        .edittable {
            border: none;
            width: 30vw;
            justify-content: center;
            margin-left: 26vw;
            margin-top: 10vw;
            width: 50vw;
            height: 30vw;
            opacity: 0.9;
            background: black;
            border: 2px solid cyan;
            text-align: center;

        }
    </style>
</head>

<body>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    $id = $_GET['id'];
    $address = "Select * from member_address where member_addressID = '$id'";
    $addressresult = mysqli_query($conn, $address);
    $rows = mysqli_fetch_array($addressresult); {

    ?>

        <form action="editaddress.php?id=<?php echo $id ?>" method="post">

            <table class="edittable">

                <tr style="height:1vw">
                    <td colspan="3">
                        <h2 style="color: cyan;font-size:30px;top:0;text-align:center;height:1vw;">Edit Address</h2>
                    </td>
                </tr>
                <tr style="padding-top: 100px;">
                    <td style="padding-top: 70px;"><textarea name="address" id="address"><?php echo $rows['memberAddress'] ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="5"><button type="submit" name="editdone" class="editdone">DONE</button></td>
                </tr>
                <tr>
                    <td colspan="5"><button type="button" name="editdone2" onclick="window.location.href='addresslist.php'" class="editdone2">CANCEL</button></td>
                </tr>
            </table>
            <?php if (isset($_POST['editdone'])) {

                $address = $_POST['address'];

                $updateaddress = "Update member_address SET memberAddress = '$address' WHERE member_addressID = '$id'";
                mysqli_query($conn, $updateaddress);

                if (mysqli_affected_rows($conn) <= 0) {
                    echo "<script>alert('Cannot Change Your Address !');</script>";
                    die("<script>window.location.href='editaddress.php?id=$id';</script>");
                } else {
                    echo "<script>alert('Address Updated Successfully!');</script>";
                    echo "<script>window.location.href='memberprofile.php?id=$id';</script>";
                }
            }
            ?>
        </form>


    <?php } ?>

    </div>
</body>

</html>
