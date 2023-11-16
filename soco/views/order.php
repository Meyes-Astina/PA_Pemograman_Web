<?php
include '../connection/connection.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location: ../views/login.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("location: ../views/login.php");
}
if (isset($_POST['submit-btn'])) {
    $name = mysqli_real_escape_string($conn, $filter_name);
    $email = mysqli_real_escape_string($conn, $filter_email);
    $number = mysqli_real_escape_string($conn, $filter_number);
    $message = mysqli_real_escape_string($conn, $filter_message);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name= '$name' AND email='$email' AND $number = '$number' AND message= '$message'") or die('query failed');
    if (mysqli_num_rows($select_message) > 0) {
        echo 'message already send';
    } else {
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
    <title>SOCO</title>
</head>

<body>
    <?php include '../views/header.php'; ?>
    <div class="banner">
        <div class="detail">
            <div class="order">
                <h1>order</h1>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="order-section">
        <div class="box-container">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM orders WHERE user_id='$user_id'") or die('Query failed: ' . mysqli_error($conn));
            if (mysqli_num_rows($select_orders) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
            ?>
                    <div class="box">
                        <p>placed on : <span><?php echo $fetch_orders['placed_on']; ?></span></p>
                        <p>name : <span><?php echo $fetch_orders['name']; ?></span></p>
                        <p>number : <span><?php echo $fetch_orders['number']; ?></span></p>
                        <p>email: <span><?php echo $fetch_orders['email']; ?></span></p>
                        <p>address : <span><?php echo $fetch_orders['address']; ?></span></p>
                        <p>payment method : <span><?php echo $fetch_orders['method']; ?></span></p>
                        <p>your order : <span><?php echo $fetch_orders['total_products']; ?></span></p>
                        <p>total price : <span><?php echo $fetch_orders['total_price']; ?></span></p>
                        <p>payment status : <span><?php echo $fetch_orders['payment_status']; ?></span></p>
                    </div>
            <?php
                }
            } else {
                echo '
                        <div class="empty">
                            <p>no order placed yet!</p>
                        </div>
                    ';
            }
            ?>
        </div>
    </div>
    <?php include '../views/footer.php'; ?>
    <!-------------- slick slider link --------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>