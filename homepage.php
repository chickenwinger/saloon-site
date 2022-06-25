<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="homepage/homepage.css">
</head>

<body>

    <?php include('navbar-footer/navbar.php'); ?>
    <div class="slider-container">
        <div class="slider-items fade-in">
            <img src="homepage/slide1.png" alt="slide1" />
        </div>
        <div class="slider-items fade-in">
            <img src="homepage/slide2.png" alt="slide2" />
        </div>
        <div class="slider-items fade-in">
            <img src="homepage/slide3.png" alt="slide3" />
        </div>
        <div class="slider-items fade-in">
            <img src="homepage/slide4.png" alt="slide4" />
        </div>
        <div class="slider-items fade-in">
            <img src="homepage/slide5.png" alt="slide5" />
        </div>
        <div class="slider-items fade-in">
            <img src="homepage/slide6.png" alt="slide6" />
        </div>

        <a class="prev" onclick="plusSlides(-1)" style="width: 15%;">&#10094;</a>
        <a class="next" onclick="plusSlides(1)" style="width: 15%;">&#10095;</a>
    </div>
    <br />
    <div class="dotss">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
        <span class="dot" onclick="currentSlide(5)"></span>
        <span class="dot" onclick="currentSlide(6)"></span>
    </div>
    <script src="homepage/homepage.js"></script>

    <div class="home-bg">
        <div style="height: 70px"></div>
        <table class="service-part">
            <tr>
                <td colspan="3">
                    <h1>S E R V I C E S</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="service-all.php?id=hair">
                        <table class="service-cat">
                            <tr>
                                <td>Hair Styling</td>
                            </tr>
                        </table>
                    </a>
                </td>
                <td>
                    <a href="service-all.php?id=design">
                        <table class="service-cat">
                            <tr>
                                <td>Custom Outfit Design Services</td>
                            </tr>
                        </table>
                    </a>
                </td>
                <td>
                    <a href="service-all.php?id=makeup">
                        <table class="service-cat">
                            <tr>
                                <td>Makeup Services</td>
                            </tr>
                        </table>
                    </a>
                </td>
            </tr>
        </table>
        <div style="height: 70px"></div>
        <table class="service-part">
            <tr>
                <td colspan="3">
                    <h1>P R O D U C T S</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="product-all.php?id=hairproduct">
                        <table class="service-cat">
                            <tr>
                                <td>Hair Products</td>
                            </tr>
                        </table>
                    </a>
                </td>
                <td>
                    <a href="product-all.php?id=makeup">
                        <table class="service-cat">
                            <tr>
                                <td>Makeup Products</td>
                            </tr>
                        </table>
                    </a>
                </td>
                <td>
                    <a href="product-all.php?id=skincare">
                        <table class="service-cat">
                            <tr>
                                <td>Skincare Products</td>
                            </tr>
                        </table>
                    </a>
                </td>
            </tr>
        </table>
        <div style="height: 70px"></div>
        <table class="service-part">
            <tr>
                <td colspan="2">
                    <h1>O U T F I T &nbsp;&nbsp; R E N T A L S</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="outfit-all.php?id=wedding">
                        <table class="service-cat">
                            <tr>
                                <td>Wedding</td>
                            </tr>
                        </table>
                    </a>
                </td>
                <td>
                    <a href="outfit-all.php?id=event">
                        <table class="service-cat">
                            <tr>
                                <td>Events</td>
                            </tr>
                        </table>
                    </a>
                </td>
            </tr>
        </table>
        <div style="height: 100px"></div>
    </div>

    <div class="why-choose">
        <div style="height: 100px"></div>
        <h1>Why Choose Us?</h1>
        <div style="height: 20px"></div>
        <p>
            We are passionate about our work. Your success is our success. We want your business to thrive and flourish and our goal
            is to help you take your business to the next level. From makeup to all-in-one packages, it is imperative that the
            overall design is properly conceptualized and presented in a fashion to best represent your company. Our primary purpose 
            is to help you achieve the look you want so it will continue to foster your dream. As your needs evolve, we will be 
            happy to help you evaluate those needs and offer you the best services to to your satisfaction.
        </p>
        <div style="height: 50px"></div>
        <a href="about-us.php">
            <div class="btn-aboutus">Learn More About Us</div>
        </a>
        <div style="height: 100px"></div>
    </div>

    <div style="height: 100px; background: url('homepage/home-bg.png') center fixed no-repeat; background-size: cover;"></div>

    <?php include('navbar-footer/footer.php'); ?>
</body>

</html>
