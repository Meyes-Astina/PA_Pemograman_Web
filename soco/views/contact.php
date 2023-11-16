<?php
include '../connection/connection.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:../views/login.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("location: ../views/login.php");
}
if(isset($_POST['submit-btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name= '$name' AND email='$email' AND $number = '$number' AND message= '$message'") or die('query failed');
    if(mysqli_num_rows($select_message)>0) {
        echo 'message already send';
    }else{
        mysqli_query($conn, "INSERT INTO `message`(`user_id`,`name`,`email`, `number`, `message`) VALUES('$user_id', '$name', '$email', '$number', '$message')") or die('query failed');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>SOCO</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <!--------------------------about us--------------------------->

    <div class="form-container">
        <h1 class="title">leave a message</h1>
        <form method="post">
            <div class="input-field">
                <label>your name</label><br>
                <input type="text" name="name">
            </div>
            <div class="input-field">
                <label>your email</label><br>
                <input type="text" name="email">
            </div>
            <div class="input-field">
                <label>number</label><br>
                <input type="number" name="number">
            </div>
            <div class="input-field">
                <label>your message</label><br>
                <textarea name="message"></textarea>
            </div>
            <button type="submit" name="submit-btn">send message</button>
        </form>
    </div>
    <div class="line"></div>
    <div class="line2"></div>
    <div class="address">
        <h1 class="title">our contact</h1>
        <div class="row">
            <div class="box">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <h4>address</h4>
                    <p>Jl. Kuaro, Gn. Kelua, Kec. Samarinda Ulu
                    </p>
                </div>
            </div>
            <div class="box">
            <i class="fas fa-phone"></i>
                <div>
                    <div>
                        <h4>phone number</h4>
                        <p>081234523465</p>
                    </div>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-envelope"></i>
                <div>
                    <h4>email</h4>
                    <p>soco@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
    <?php include '../views/footer.php'; ?>
    <!-------------- slick slider link --------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>