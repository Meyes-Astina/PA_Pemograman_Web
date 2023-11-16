<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Document</title>

</head>

<body>
    <header class="header">
        <div class="flex">
            
            <input type="checkbox" name="" id="toggler">
            <label for="toggler" class="fas fa-bars"></label>
            <nav class="navbar">
                <a href="../views/index.php">Home</a>
                <a href="../views/about.php">About Us</a>
                <a href="../views/shop.php">Shop</a>
                <a href="../views/order.php">Order</a>
                <a href="../views/contact.php">Contact</a>
            </nav>
            <a href="../views/admin_pannel.php"><img src="../img/logo.png" class="logo" width="150px"></a>
            <?php
            $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'")
                or die('Query failed');
            $cart_num_rows = mysqli_num_rows($select_cart);
            ?>
            <div class="icons">
                <a href="../views/cart.php"><i class="fas fa-cart-plus"></i><sup><?php echo $cart_num_rows; ?></sup></a>
                <a href = "../views/logout.php"><i class="fas fa-user-alt" id="user-btn"></i></a>
            </div>
            <div class="user-box">
                <p>Username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p> 
                <form method="post">
                    <button type="submit" name="logout" class="logout-btn">log out</button>
                </form>
            </div>
        </div>
    </header>
    <!-------------- slick slider link --------------->
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
    </script>
    <script>
        function toggleUserBox() {
            const userBox = document.getElementById("user-box");
            userBox.classList.toggle("show");
        }

        document.addEventListener("DOMContentLoaded", function () {
            const toggler = document.getElementById("toggler");
            const navbar = document.querySelector(".navbar");

            toggler.addEventListener("change", function () {
                if (this.checked) {
                    navbar.style.clipPath = "polygon(0 0, 100% 0, 100% 100%, 0 100%)";
                } else {
                    navbar.style.clipPath = "polygon(0 0, 100% 0, 100% 0, 0 0)";
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

</body>

</html>