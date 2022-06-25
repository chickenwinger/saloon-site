<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="outfit/outfit-page.css">
</head>

<body>
    <?php include("navbar-footer/navbar.php") ?>

    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');

    $id = $_GET['outfitID'];
    $sql = "SELECT * FROM outfit_list WHERE outfitID = $id";
    $result = mysqli_query($conn, $sql);
    ?>

    <div style="position: absolute; margin-left: 20px; margin-top: 20px;">
        <?php $rows = mysqli_fetch_array($result) ?>
        <p>
            <a href="outfit-all.php" style="color: black;">
                <i class="fa fa-arrow-circle-left" style="font-size:48px; cursor:pointer"></i>
            </a>
        </p>
    </div>
    <form action="checkout.php" method="POST">
        <table class="table1">
            <tr>
                <td rowspan="100" class="outfit-img">
                    <img src="<?php echo $rows['outfitPicture'] ?>" height="100%" style="border: solid 2px black;">
                </td>
            </tr>
            <tr>
                <td class="content1"><b><?php echo $rows['outfitTitle'] ?></b></td>
            </tr>
            <tr>
                <td class="content2"><i><?php echo $rows['outfitDescription'] ?></i></td>
            </tr>
            <tr>
                <td class="content3">RM<?php echo $rows['outfitPrice'] ?>/Day</td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <select class="select1" name="rentSize" required>
                        <option selected disabled value="">-Select Size-</option>
                        <?php
                        $size_select = "SELECT * FROM outfit_size WHERE outfitID = '".$_GET['outfitID']."' AND outfitstock != 0";
                        $result_size = mysqli_query($conn, $size_select);
                        ?>
                        <?php while ($row_size = mysqli_fetch_array($result_size)) { ?>
                        <option value="<?php echo $row_size['outfitSize']; ?>"><?php echo $row_size['outfitSize']; ?></option>
                        <?php } ?>
                    </select>
                    <button type="button" class="btn-size-charts">?</button>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <select class="select1" name="rentDuration" required>
                        <option selected disabled value="">-Select Rental Duration-</option>
                        <option value="1">1 Day</option>
                        <option value="2">2 Days</option>
                        <option value="3">3 Days</option>
                        <option value="4">4 Days</option>
                        <option value="5">5 Days</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <input class="date1" type="date" name="rentDate" required>
                </td>
            </tr>
            <tr>
                <td style="height: 10px"></td>
            </tr>
            <tr>
                <td style="text-align: center" style="text-align: center;">
                    <input type="hidden" name="total" value="<?php echo $rows['outfitPrice'] ?>">
                    <input type="hidden" name="outfitID" value="<?php echo $rows['outfitID']; ?>">
                    <b><button class="button" type="submit" name="btnRent">RENT OUTFIT</button></b><br>
                    <p style="color: red; font-size: 14px;">*All outfits rented are to be self-picked up from our studio.</p>
                    <p style="color: red; font-size: 14px;">**We will not be responsible for any outfit</p>
                    <p style="color: red; font-size: 14px;">that is not picked up.</p>
                </td>
            </tr>
        </table>
    </form>

    <div class="size-bg">
        <div class="close-size">
            <i class="fa fa-close close2" style="font-size:36px;color:white"></i>
        </div>
        <div class="size-container">
            <?php if ($rows['outfitGender'] == 'female') { ?>
                <img src="outfit/outfit-image/size_chart.png" width="800px" alt="">
            <?php } else if ($rows['outfitGender'] == 'male') { ?>
                <img src="outfit/outfit-image/size_chart2.png" width="700px" alt="">
            <?php } ?>
        </div>

    </div>

    <div style="height: 5vw"></div>
    <script src="outfit/outfit-page.js"></script>

    <?php include("navbar-footer/footer.php") ?>
</body>

</html>
