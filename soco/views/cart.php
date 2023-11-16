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

//update qty
if (isset($_POST['update_qty_btn'])){
    $update_qty_id = $_POST['update_qty_id'];
    $update_value = $_POST['update_qty'];

    $update_query = mysqli_query($conn, "UPDATE cart SET quantity = '$update_value' WHERE id ='$update_qty_id'") or die('query failed');
    if ($update_query) {
        header('location:../views/cart.php');
    }
}

// delete products froom database
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM cart WHERE id = '$delete_id'") or die('query failed');

    header('location:../views/cart.php');
}

// delete products froom database
if (isset($_GET['delete_all'])) {

    mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'") or die('query failed');

    header('location:../views/cart.php');
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
    <?php include '../views/header.php';?>
    <div class="banner">
        <div class="detail">
        <div class="linecart"></div>
            <h1>my cart</h1>
        </div>
    </div>
    <div class="line"></div>
    <section class="shop">
        <h1 class="title">products added in cart</h1>
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

        <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM cart") or die('query failed');
        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $total_amt = floatval($fetch_cart['price']) * floatval($fetch_cart['quantity']); // Hitung total amount di sini
                ?>
                <div class="box">
                    <div class="icon">
                        <a href="../views/viewpage.php?pid=<?php echo $fetch_cart['id']; ?>" class="bi bi-eye-fill"></a>
                        <a href="../views/cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="bi bi-x" onclick="return confirm('do u want to delete this product from ur cart?')"></a>
                        <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                    </div>
                    <img src="image/<?php echo $fetch_cart['image']; ?>" alt="">
                    <div class="price">Rp.<?php echo $fetch_cart['price']; ?></div>
                    <div class="name"><?php echo $fetch_cart['name']; ?></div>
                    <form method="post">
                        <input type="hidden" name="update_qty_id" value="<?php echo $fetch_cart['id']; ?>">
                        <div class="qty">
                            <input type="number" min="1" name="update_qty" value="<?php echo $fetch_cart['quantity']; ?>">
                            <input type="submit" name="update_qty_btn" value="update">
                        </div>
                    </form>
                    <div class="total-amt">
                        Total Amount: <span>Rp.<?php echo number_format($total_amt, 2); ?></span>
                    </div>
                </div>
                <?php
                        $grand_total += $total_amt;
                    }
                } else {
                    echo '<p class="empty">no products added yet</p>';
                }
                ?>
        </div>
        <div class="dlt">
            <a href="../views/cart.php?delete_all" class="btn" onclick="return confirm('do u want to delete all items in your wishlist')">delete all</a>
        </div>
        <div class="wishlist_total">
            <p>total amount payable : <span>Rp.<?php echo $grand_total; ?> /-</span></p>
            <a href="../views/shop.php" class="btn">continue shopping</a>
            <a href="../views/checkout.php" class="btn <?php echo ($grand_total>1) ? '' : 'disabled' ?>" onclick="return 
            confirm('do u want to delete all items in ur wishlist?')">Payment</a>
        </div>
    </section>
    <?php include '../views/footer.php'; ?>
    <!-------------- slick slider link --------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>