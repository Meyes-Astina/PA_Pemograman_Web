<?php
    include '../connection/connection.php';
    session_start();
    $admin_id = $_SESSION['admin_name'];

    if (!isset($admin_id)) {
        header('location:../views/login.php');
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header('location:../views/login.php');
    }

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];

        mysqli_query($conn, "DELETE FROM orders WHERE id = '$delete_id'") or die('query failed');
        $message[]='user removed successfully';
        header('location:../views/admin_order.php');
    }

    if (isset($_POST['update_order'])) {
        $order_id = $_POST['order_id'];
        $update_payment = $_POST['update_payment'];

        mysqli_query($conn, "UPDATE orders SET payment_status = '$update_payment' WHERE id='$order_id'") or die('query failed');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href='../style.css'>
    <title>Admin Order</title>
</head>
<body>
    <?php include '../views/admin_header.php'; ?>
    <?php
        if (isset($message)) {
            foreach ($message as $message) {
                echo '
                    <div class="message">
                        <span>'.$message.'</span>
                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>
                ';
            }
        }
    ?>
    <div class="line4"></div>
    <section class="order-container">
        <h1 class="title">total user account</h1>
        <div class="box-container">
            <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM orders") or die('query failed');
                if (mysqli_num_rows($select_orders)>0) {
                    while($fetch_orders = mysqli_fetch_assoc($select_orders)) {

            ?>
            <div class="box">
                <p>user name: <span><?php echo $fetch_orders['name']; ?></span></p>
                <p>user id: <span><?php echo $fetch_orders['user_id']; ?></span></p>
                <p>placed on: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
                <p>number : <span><?php echo $fetch_orders['number']; ?></span></p>
                <p>email : <span><?php echo $fetch_orders['email']; ?></span></p>
                <p>total_price : <span><?php echo $fetch_orders['total_price']; ?></span></p>
                <p>address : <span><?php echo $fetch_orders['address']; ?></span></p>
                <p>total_product : <span><?php echo $fetch_orders['total_products']; ?></span></p>
                <form method="post">
                    <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                    <select name="update_payment">
                        <option disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
                        <option value="pending">Pending</option>
                        <option value="complete">Complete</option>
                    </select>
                    <input type="submit" name="update_order" value="update payment" class="btn">
                    <a href="../views/admin_order.php?delete=<?php echo $fetch_orders['id']; ?>" class="btn" onclick="return confirm('delete this message');">delete</a>
                </form>
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
    </section>
    <div class="line"></div>
    <?php include '../views/footer.php'; ?>
    <script type="text/javascript" src="../js/script.js"></script>
</body>
</html>