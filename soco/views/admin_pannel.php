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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>admin pannel</title>
</head>
<body>
    <?php include '../views/admin_header.php'; ?>
    <div class="line4"></div>
    <section class="dashboard">
        <div class="box-container">
            <div class="box">
                <?php
                    $total_pendings = 0;
                    $select_pendings = mysqli_query($conn, "SELECT * FROM orders WHERE payment_status = 'pending' ") or die('query failed');
                    while ($fetch_pendings = mysqli_fetch_assoc($select_pendings)) {
                        $total_pendings += $fetch_pendings['total_price'];
                    }
                ?>
                 <h3>Rp. <?php echo $total_pendings; ?>/-</h3>
                 <p>total pendings</p>
            </div>
            <div class="box">
                <?php
                    $total_completes = 0;
                    $select_completes = mysqli_query($conn, "SELECT * FROM orders WHERE payment_status = 'complete' ") or die('query failed');
                    while ($fetch_completes = mysqli_fetch_assoc($select_completes)) {
                        $total_completes += $fetch_completes['total_price'];
                    }
                ?>
                 <h3>Rp. <?php echo $total_completes; ?>/-</h3>
                 <p>total completes</p>
            </div>
            <div class="box">
                <?php
                    $select_orders = mysqli_query($conn, "SELECT * FROM orders ") or die('query failed');
                    $num_of_orders = mysqli_num_rows($select_orders);
                ?>
                 <h3><?php echo $num_of_orders; ?></h3>
                 <p>order placed</p>
            </div>
            <div class="box">
                <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM orders ") or die('query failed');
                    $num_of_products = mysqli_num_rows($select_products);
                ?>
                 <h3><?php echo $num_of_products; ?></h3>
                 <p>product added</p>
            </div>
            <div class="box">
                <?php
                    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'user' ") or die('query failed');
                    $num_of_users = mysqli_num_rows($select_users);
                ?>
                 <h3><?php echo $num_of_users; ?></h3>
                 <p>total normal users</p>
            </div>
            <div class="box">
                <?php
                    $select_admin = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'admin' ") or die('query failed');
                    $num_of_admin = mysqli_num_rows($select_admin);
                    ?>
                 <h3><?php echo $num_of_admin; ?></h3>
                 <p>total normal admin</p>
            </div>
            <div class="box">
                <?php
                    $select_users = mysqli_query($conn, "SELECT * FROM users ") or die('query failed');
                    $num_of_users = mysqli_num_rows($select_users);
                ?>
                 <h3><?php echo $num_of_users; ?></h3>
                 <p>total register users</p>
            </div>
            <div class="box">
                <?php
                    $select_message = mysqli_query($conn, "SELECT * FROM message ") or die('query failed');
                    $num_of_message = mysqli_num_rows($select_message);
                ?>
                 <h3><?php echo $num_of_message; ?></h3>
                 <p>new message</p>
            </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggler = document.getElementById("toggler");
            const navbar = document.querySelector(".navbar");

            toggler.addEventListener("change", function() {
                if (this.checked) {
                    navbar.style.clipPath = "polygon(0 0, 100% 0, 100% 100%, 0 100%)";
                } else {
                    navbar.style.clipPath = "polygon(0 0, 100% 0, 100% 0, 0 0)";
                }
            });
        });
    <?php include '../views/footer.php'; ?>
    </script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>
</html>