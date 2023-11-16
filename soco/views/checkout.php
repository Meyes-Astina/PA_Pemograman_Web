<?php
include '../connection/connection.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location: ../views/login.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:../views/login.php");
}
if (isset($_POST['order_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'flat no. ' . $_POST['flate'] . ',' . $_POST['street'] . ',' . $_POST['city'] . ',' . $_POST['state'] . ',' . $_POST['country'] . ',' . $_POST['pin']);
    $placed_on = date('d-M-Y');
    $cart_total = 0;
    $cart_product[] = '';
    $cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id='$user_id'") or die('query failed');

    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_product[] = ($cart_item['name'] . ' (' . $cart_item['quantity']. ') '); 
            $cart_total += floatval($cart_item['price']) * floatval($cart_item['quantity']);
        }        
    }
    $total_product = implode($cart_product);
    mysqli_query($conn, "INSERT INTO orders (user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES ('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_product','$cart_total','$placed_on')");
    mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");
    $message[] = 'order placed successfully';
    header('location:../views/checkout.php');
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
            <h1>order</h1>
            <a href="../views/index.php">Home</a><span>/ order</span>
        </div>
    </div>
    <div class="line"></div>
    <div class="checkout-form">
        <h1 class="title">payment process</h1>
        <?php
        if (isset($message)) {
            foreach ($message as $message) {
                echo '<div class="message">
                    <span>' . $message . '</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                </div>';
            }
        }
        ?>
        <div class="display-order">
        <div class="box-container">
                <?php
                $grand_total = 0;
                $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id='$user_id'") or die('query failed');
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                    $total_amt = floatval($fetch_cart['price']) * floatval($fetch_cart['quantity']); // Hitung total amount di sini
                    $grand_total += $total_amt; // Akumulasi total amount di sini

                ?>
                    <div class="box">
                        <img src="../image/<?php echo $fetch_cart['image']; ?>">
                        <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
                    </div>
                <?php
                }
                ?>
            </div>
            <span class="grand-total">Total Amount Payable : Rp.<?php echo $grand_total; ?> /-</span>
        </div>
        <form method="post" class="box">
            <div class="input-field">
                <label>your name</label>
                <input type="text" name="name" placeholder="enter ur name">
            </div>
            <div class="input-field">
                <label>your number</label>
                <input type="number" name="number" placeholder="enter ur number">
            </div>
            <div class="input-field">
                <label>your email</label>
                <input type="text" name="email" placeholder="enter ur email">
            </div>
            <div class="input-field">
                <label>select payment method</label>
                <select name="method">
                    <option selected disabled>select payment method</option>
                    <option value="cash on delivery">cash on delivery</option>
                    <option value="credit card">credit card</option>
                    <option value="paytm">paytm</option>
                    <option value="paypal">paypal</option>
                </select>
            </div>
            <div class="input-field">
                <label>address line 1</label>
                <input type="text" name="flate" placeholder="e.g flate no.">
            </div>
            <div class="input-field">
                <label>address line 2</label>
                <input type="text" name="flate" placeholder="e.g street name">
            </div>
            <div class="input-field">
                <label>city</label>
                <input type="text" name="city" placeholder="e.g samarinda">
            </div>
            <div class="input-field">
                <label>state</label>
                <input type="text" name="state" placeholder="e.g Indo">
            </div>
            <div class="input-field">
                <label>country</label>
                <input type="text" name="country" placeholder="Indonesia">
            </div>
            <div class="input-field">
                <label>pin code</label>
                <input type="text" name="flate" placeholder="e.g 666666">
            </div>
            <input type="submit" name="order_btn" class="btn" value="order now">
        </form>
    </div>
    <?php include '../views/footer.php'; ?>
    <!-------------- slick slider link --------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>