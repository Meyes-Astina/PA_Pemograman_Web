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
//adding product in wishlist
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_image = $_POST['product_image'];

    $cart_num = mysqli_query($conn, "SELECT * FROM cart WHERE name= '$product_name' AND user_id= '$user_id'") or die('query failed');

    $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' AND pid = '$product_id'");
    include("../connection/connection.php");
    if (mysqli_num_rows($select_cart) > 0) {
        // $message = 'Product already exists in the cart';
    } else {
        // Menambahkan produk ke keranjang jika belum ada
        $insert_query = "INSERT INTO cart (user_id, pid, name, price, quantity, image) 
                                VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')";

        if (mysqli_query($conn, $insert_query)) {
            $message = 'Product successfully added to the cart';
        } else {
            $message = 'Failed to add product to the cart: ' . mysqli_error($conn);
        }
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
            <div class="shop">
                <h1>our shop</h1>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <section class="shop">
        <h1 class="title">shop best sellers</h1>
        <?php
        if (isset($message) && is_array($message)) {
            foreach ($message as $message) {
                echo '<div class="message">
                    <span>' . $message . '</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                </div>';
            }
        }
        ?>
        <div class="box-container">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM products") or die('query failed');

            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <form method="post" class="box">
                        <img src="../image/<?php echo $fetch_products['image']; ?>" alt="">
                        <p>Price: Rp.<?php echo $fetch_products['price']; ?></p>
                        <h4><?php echo $fetch_products['name']; ?></h4>
                        <h4 style="display:none" name="product_quantity" id="product_quantity_value" value="1" min="1"></h4>
                        <details><?php echo $fetch_products['product_detail']; ?></details>
                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_quantity" value="1">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <div class="icon">
                            <a href="viewpage.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-shopping-bag"></a>
                            <button type="submit" name="add_to_cart" class="fas fa-cart-plus"><a href="../views/cart.php"></a></button>
                        </div>
                    </form>
            <?php
                }
            } else {
                echo '<p class="empty">No products added yet</p>';
            }
            ?>
        </div>
    </section>
    <?php include '../views/footer.php'; ?>
    <!-------------- slick slider link --------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>
