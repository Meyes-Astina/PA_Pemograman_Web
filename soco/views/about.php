<?php
    include '../connection/connection.php';
    session_start();
    $user_id= $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location: ../views/login.php');
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header('../views/login.php');
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SOCO</title>
</head>

<body>
    <?php include '../views/header.php';?>
    <div class="line"></div>

    <!-- features -->
    <div class="line4"></div>
    <div class="features">
        <div class="title">
            <h1>BEST FEATURES</h1>
        </div>
        <div class="row">
            <div class="box">
                <img src="../img/online.png" alt="img" width="80px">
                <h4>24 x 7 online support</h4>
                <p>online support</p>
            </div>
            <div class="box">
                <img src="../img/moneynew.png" alt="img" width="80px">
                <h4>Money back</h4>
                <p>online support</p>
            </div>
            <div class="box">
                <img src="../img/giftcard.png" alt="img" width="80px">
                <h4>special gift card</h4>
                <p>online support</p>
            </div>
            <div class="box">
                <img src="../img/shipping.png" alt="img" width="80px">
                <h4>worldwide shipping</h4>
                <p>online support</p>
            </div>
        </div>
    </div>
    <!-- features -->

    <!-- team section -->
    <div class="line2"></div>
    <div class="team">
        <div class="title">
            <h1>Our workable team</h1>
            <span>best team</span>
        </div>
        <div class="row">
            <div class="box">
                <div class="img-box">
                <img src="../img/aurel.jpg" alt="img" width="80px">
                </div>
                <div class="detail">
                    <span>Sabina Nurlatifah Aurelia</span>
                    <h4>2209106002</h4>
                    <div class="icons">
                        <a href="https://www.instagram.com/sbnaurelli/"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                <img src="../img/maya.jpg" alt="img1">
                </div>
                <div class="detail">
                    <span>Maya Agustina</span>
                    <h4>2209106005</h4>
                    <div class="icons">
                        <a href="https://www.instagram.com/mayasyah12/"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                <img src="../img/gebi.jpg" alt="img2">
                </div>
                <div class="detail">
                    <span>Gabriella Caesaria Vianney</span>
                    <h4>2209106007</h4>
                    <div class="icons">
                        <a href="https://www.instagram.com/___.me2___/"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line2">
        <div class="ideas">
            <div class="title">
                <h1>we and our clients are happy to cooperate with our company</h1>
                <span>our features</span>
                <br><br><br>
    <!-- team section -->
    <?php include '../views/footer.php';?>
    <!-------------- slick slider link --------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>