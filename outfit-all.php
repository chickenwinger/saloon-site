<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Outfits</title>
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.0/dist/aos.css">
    <link rel="stylesheet" href="outfit/outfit-all.css">

</head>

<body>
    <?php include("navbar-footer/navbar.php") ?>

    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');

    if (!isset($_GET['id'])) {
        $sql = "SELECT * FROM outfit_list ORDER BY RAND()";
    } elseif ($_GET['id'] == "wedding") {
        $sql = "SELECT * FROM outfit_list where outfitCategory like '%wedding%'";
    } elseif ($_GET['id'] == "event") {
        $sql = "SELECT * FROM outfit_list where outfitCategory like '%event%'";
    } elseif ($_GET['id'] == "festive season") {
        $sql = "SELECT * FROM outfit_list where outfitCategory like '%festive season%'";
    } elseif ($_GET['id'] == "cultural") {
        $sql = "SELECT * FROM outfit_list where outfitCategory like '%cultural%'";
    }
    $result = mysqli_query($conn, $sql);

    ?>

    <div class="sidebar" id="sidebar1">

        <a href="outfit-all.php" class="btn <?php if (!isset($_GET['id'])) {
                                                echo "active";
                                            } ?>">All</a>
        <a href="outfit-all.php?id=wedding" class="btn <?php if (isset($_GET['id']) && $_GET['id'] == "wedding") {
                                                            echo "active";
                                                        } ?>">Wedding Outfit</a>
        <a href="outfit-all.php?id=event" class="btn <?php if (isset($_GET['id']) && $_GET['id'] == "event") {
                                                            echo "active";
                                                        } ?>">Event Outfit</a>
    </div>
    <!-- 1 -->
    <table style="margin-left: 192px; border-spacing: 50px; width: 86.9%;">
        <tr>
            <?php
            $column = 1;
            $row = 4;
            while ($rows = mysqli_fetch_array($result)) {
                if ($row < $column) {
                    echo "</tr><tr>";
                    $row += 4;
                } ?>
                <td class="content-td">
                    <div class="box-shadow" data-aos="fade-up">
                        <form action="outfit-page.php?outfitID=<?php echo $rows['outfitID']; ?>" method="POST">
                            <div class="content-img">
                                <img src="<?php echo $rows['outfitPicture']; ?>" alt="">
                            </div>
                            <div style="background: white" class="content-title">
                                <h4><?php echo $rows['outfitTitle']; ?></h4>
                            </div>
                            <button type="submit" class="content-btn"></button>
                        </form>
                    </div>
                    <script>
                        AOS.init({
                            duration: 1000,
                        })
                    </script>
                </td>
            <?php
                $column += 1;
            }
            ?>
        </tr>
    </table>

    <?php include("navbar-footer/footer.php"); ?>

</body>

</html>
