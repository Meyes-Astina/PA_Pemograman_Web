<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>SOCO</title>
</head>
<body>
    <header class="header">
        <div class="flex">
        <input type="checkbox" name="" id="toggler">
            <label for="toggler" class="fas fa-bars"></label>
            <nav class="navbar">
                <a href="../views/admin_pannel.php">home</a>
                <a href="../views/admin_product.php">products</a>
                <a href="../views/admin_order.php">orders</a>
                <a href="../views/admin_user.php">users</a>
                <a href="../views/admin_message.php">messages</a>
            </nav>
            <a href="../views/admin_pannel.php" class="logo"><img src="../img/logo.png" class="logo" width="150px"></a>
            <div class="icons">
                <i class="fas fa-user-alt" id="user-btn"></i>
                <i class="fas fa-grip-vertical" id="menu-btn"></i>
            </div>
            <div class="user-box">
                <p>Username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <form method="post">
                    <button type="submit" name="logout" class="logout-btn">log out</button>
                </form>
            </div>
        </div>
    </header>
    <div class="line2"></div>
    <div class="banner">
        <div class="detail">
            <h1>admin dashboard</h1>
        </div>
    </div>
    <div class="line"></div>
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
    <script type="text/javascript" src="../js/script.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>
</html>