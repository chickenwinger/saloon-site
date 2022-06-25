<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>About Us</title>
  <link rel="stylesheet" href="navbar-footer-login/navbar.css" />
  <link rel="stylesheet" href="navbar-footer-login/footer.css" />
  <link rel="stylesheet" href="navbar-footer-login/login.css" />
  <link rel="stylesheet" href="homepage/homepage.css" />
  <style>
    .aboutus-bg {
      background: url(homepage/home-bg.png) center center no-repeat fixed;
      background-size: cover;
      width: 100%;
      height: 1400px;
    }

    .aboutus-content {
      background: white;
      width: 100%;
      height: 380px;
      box-shadow: 5px 5px 10px grey;
      text-align: center;
      font-family: Arial;
    }

    .aboutus-skl {
      font-size: 20px;
      font-family: cursive;
    }

    .fa2 {
      padding: 20px !important;
      font-size: 30px !important;
      width: 50px !important;
      text-align: center !important;
      text-decoration: none !important;
      margin: 5px 2px !important;
    }
  </style>
</head>

<body>
  <?php include('navbar-footer/navbar.php'); ?>

  <div class="aboutus-bg">
    <div style="height: 80px"></div>
    <div class="aboutus-content">
      <div style="height: 50px;"></div>
      <h1>A B O U T &nbsp;&nbsp; U S</h1>
      <p class="aboutus-skl">
        Welcome to ON9 Fashion Studio! ON9 Fashion Co,.Ltd was founded by Jackie Chee. <br />
        It was inspired by a group of enthusiasts who love about fashion. <br />
        It was started because Chee realised that there were very less fashion studio <br />
        that provide doorstep services. We are currently operating in Kuala Lumpur and Selangor <br />
        only. We will consider to expand to all the states in future. Our objective is to <br />
        provide our best services to fulfill people's desired fashion appearance. <br />
      </p>
    </div>
    <div style="height: 80px;"></div>
    <div class="aboutus-content">
      <div style="height: 50px;"></div>
      <h1>W H Y &nbsp;&nbsp; C H O O S E &nbsp;&nbsp; U S</h1>
      <p class="aboutus-skl">
        We are passionate about our work. Your success is our success. We want your business to thrive and flourish and our goal <br>
        is to help you take your business to the next level. From makeup to all-in-one packages, it is imperative that the <br>
        overall design is properly conceptualized and presented in a fashion to best represent your company. Our primary purpose <br>
        is to help you achieve the look you want so it will continue to foster your dream. As your needs evolve, we will be <br>
        happy to help you evaluate those needs and offer you the best services to to your satisfaction. <br>
      </p>
    </div>
    <div style="height: 80px;"></div>
    <div class="aboutus-content" style="height: 300px;">
      <div style="height: 50px;"></div>
      <h1>
        F O L L O W &nbsp;&nbsp; O U R &nbsp;&nbsp; S O C I A L &nbsp;&nbsp; M
        E D I A
      </h1>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
      <div style="height: 50px"></div>
      <div>
        <a href="#" onclick="return false;" class="fa fa-facebook" style="border-radius: 0; color: black; font-size: 30px; width: 60px; border: 1px solid black"></a>
        <a href="#" onclick="return false;" class="fa fa-twitter" style="border-radius: 0; color: black; font-size: 30px; width: 60px; border: 1px solid black"></a>
        <a href="#" onclick="return false;" class="fa fa-instagram" style="border-radius: 0; color: black; font-size: 30px; width: 60px; border: 1px solid black"></a>
      </div>
    </div>
  </div>

  <?php include('navbar-footer/footer.php') ?>
</body>

</html>
