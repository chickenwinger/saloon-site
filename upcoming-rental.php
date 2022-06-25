<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="upcoming-activity.css">
    <title>Upcomings</title>
    <style>
        .upc-rental2 {
            position: fixed;
            background: white;
            border: 3px solid black;
            padding: 1vw;
            color: black;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            top: 20%;
            right: -21%;
            font-size: 25px;
            font-weight: 700;
            cursor: pointer;
            outline: none;
            z-index: 99999;
            transition: 0.5s;
        }

        .upc-rental2:hover {
            right: 0;
            background: black;
            color: white;
            box-shadow: 10px 10px 10px grey;
            transition: 0.5s;
        }
    </style>
</head>

<body>
    <div style="height: 60px"></div>
    <h1 style="text-align: center">Upcoming / On-Rents</h1>
    <h3 style="text-align: center; color: red;">**Please pick up your outfit 1 or 2 days before your rental date!**</h3>
    <h3 style="text-align: center; color: red;">**We are not responsible for any late pick-up**</h3>
    <div style="height: 60px"></div>
    <form action="" method="post">
        <button class="upc-rental2" id="upc-appointment" type="submit" name="upc-appointment">
            < &nbsp;&nbsp; Upcoming Appointments </button> </form> <?php
                                                                    $select_outfit = "SELECT *, DATE_ADD(ore.rentalDate, INTERVAL ore.rentalDuration DAY) AS finish_date  FROM outfit_size os INNER JOIN outfit_rental ore ON os.outfit_sizeID = ore.outfit_sizeID INNER JOIN outfit_list ol ON ore.outfitID = ol.outfitID WHERE ore.memberID = '" . $_SESSION['id'] . "' AND ore.depositStatus = 'on-hold' AND ore.outfitReturn = 'on-rent' AND CURDATE() <= DATE_ADD(ore.rentalDate, INTERVAL ore.rentalDuration DAY)";
                                                                    $result_outfit = mysqli_query($conn, $select_outfit);
                                                                    ?> <?php while ($row_outfit = mysqli_fetch_array($result_outfit)) { ?> <table class="appointment-table">
                <tr>
                    <td rowspan="999" class="image-td">
                        <img src="<?php echo $row_outfit['outfitPicture']; ?>" alt="" width="100%">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: 700;" class="appointment-content">
                        <?php echo $row_outfit['outfitTitle']; ?>
                    </td>
                    <button disabled type="button" class="appointment-status" <?php if ($row_outfit['rentalDate'] < date("Y-m-d")) {
                                                                                    echo "style='color: lime; border: 2px solid lime'";
                                                                                } ?>>
                        <?php
                                                                            if ($row_outfit['rentalDate'] < date("Y-m-d")) {
                                                                                echo $row_outfit['outfitReturn'];
                                                                            } else {
                                                                                echo "To pick up";
                                                                            }
                        ?>
                    </button>
                </tr>
                <tr>
                    <td>
                        <hr size="1">
                    </td>
                </tr>
                <tr>
                    <td class="appointment-content">
                        Start Date: <?php echo $row_outfit['rentalDate']; ?>
                    </td>
                </tr>
                <tr>
                    <td class="appointment-content">
                        End Date: <?php echo $row_outfit['finish_date']; ?>
                    </td>
                </tr>
                <tr>
                    <td class="appointment-content">
                        Duration: <?php echo $row_outfit['rentalDuration']; ?> Day(s)
                    </td>
                </tr>
                <tr>
                    <td class="appointment-content">
                        Outfit Size: <?php echo $row_outfit['outfitSize']; ?>
                    </td>
                </tr>
                <tr>
                    <td class="appointment-content">
                        Outfit Price: RM <?php echo ($row_outfit['outfitPrice'] * $row_outfit['rentalDuration']); ?>
                    </td>
                </tr>
                <tr>
                    <td class="appointment-content">
                        Outfit Deposit: RM <?php echo ($row_outfit['outfitPrice'] * 3); ?> (To be claimed after outfit is returned unscathed)
                    </td>
                </tr>
                </table>
                <div style="height: 30px"></div>
            <?php } ?>
                                                                            

</body>

</html>
