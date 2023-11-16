<?php
    include '../connection/connection.php';
    session_start();
    $user_id= $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location: ../views/login.php');
    }
    if (isset($_POST['logout'])) {
        session_destroy();
        header('location:../views/login.php');
    }
    //adding product in wishlist
    if(isset($_POST['add_to_wishlist'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];

        $wishlist_number = mysqli_query($conn, "SELECT * FROM  wishlist WHERE name= '$product_name' AND user_id= '$user_id'") or die ('query failed');
        $cart_num = mysqli_query($conn, "SELECT * FROM  cart WHERE name= '$product_name' AND user_id= '$user_id'") or die ('query failed');
        if(mysqli_num_rows($wishlist_number) > 0){
            $message= 'product already exist in wishlist';
        }else if(mysqli_num_rows($cart_num)>0){
            $message= 'product already exist in cart';
        }else{
            mysqli_query($conn, "INSERT INTO wishlist (user_id, pid, name, price, image) 
            VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')");
            $message= 'product successfully added to wishlist';
        }

    }
    //adding product in cart
    if(isset($_POST['add_to_cart'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];
    
        $cart_num = mysqli_prepare($conn, "SELECT * FROM cart WHERE name = ? AND user_id = ?");
        mysqli_stmt_bind_param($cart_num, "si", $product_name, $user_id);
        mysqli_stmt_execute($cart_num);
    
        $result = mysqli_stmt_get_result($cart_num);
    
        if(mysqli_num_rows($result) > 0) {
            $message[] = 'Product already exists in the cart';
        } else {
            $insert_query = mysqli_prepare($conn, "INSERT INTO cart (user_id, pid, name, price, quantity, image) 
                                VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')");
                        if(mysqli_stmt_execute($insert_query)) {
                $message[] = 'Product successfully added to the cart';
            } else {
                $message[] = 'Failed to add product to cart';
            }
    
            mysqli_stmt_close($insert_query);
        }
    
        mysqli_stmt_close($cart_num);
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
    <!-------------- slick slider link --------------->
    <?php include '../views/header.php'; ?>
    <div class="container-fluid">
        <div class="hero-slider">
            <div class="slider-item">
                <img src="../img/img1.jpg">
                <div class="slider-caption">
                    <h1>COSRX <br>Clarifying Treatment Toner</h1>
                    <a href="../views/shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="../img/img2new.png">
                <div class="slider-caption">
                    <h1>COSRX <br>Salicylic Acid <br> Daily Gentle Cleanser</h1>
                    <a href="../views/shop.php" class="btn">shop now</a>
                </div>
            </div>
        </div>
        <div class="controls">
            <i class="fas fa-angle-left prev"></i>
            <i class="fas fa-angle-right next"></i>
        </div>
    </div>
    <!-- <div class="line"></div> -->
    <div class="services">
        <div class="row">
            <div class="box">
                <img src="../img/shipping.png" alt="img0" width="25%">
                <div>
                    <h1>Free Shipping Fast</h1>
                </div>
            </div>
            <div class="box">
                <img src="../img/moneynew.png" alt="img1" width="25%">
                <div>
                    <h1>Money Back and Guarantee</h1>
                </div>
            </div>
            <div class="box">
                <img src="../img/online.png" alt="img2" width="25%">
                <div>
                    <h1>Online Support</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="line2"></div>
    <div class="story">
        <div class="row">
            <div class="box">
                <h1>Promotion for 11.11 day</h1>
                    <br><br>
                    <a href="../views/shop.php" class="btn">shop now</a>
            </div>
            <div class="box">
                <img src="../img/width.jpg" alt="gmbr">
            </div>
        </div>
    </div>
    <div class="line3"></div>
        <div class="discover">
            <div class="detail">
                <h1 class="title">Radiant skin begins with self-love. Nurture your skin, and let your inner glow shine through</h1>
                <span>Buy now and save 40%</span>
                    <a href="../views/shop.php" class="btn">discover now</a>
            </div>
            <div class="img-box">
                <img src="../img/img3.jpg" alt="img">
            </div>
        </div>
        <div class="line3"></div>
    </div>
    <div class="line2"></div>
    <div class="newslatter">
        <h1 class="title">Explore and Shop Now in SOCO</h1>
        <a href="../views/shop.php" class="btn">Shop Now</a>
    </div>
    <div class="line3"></div>
    <div class="client">
        <div class="box">
            <img src="../img/skintific.png" alt="img0" width="65%">
        </div>
        <div class="box">
            <img src="../img/wardah.png" alt="img1"width="80%">
        </div>
        <div class="box">
            <img src="../img/somethiinc.png" alt="img2" width="70%">
        </div>
        <div class="box">
            <img src="../img/scarlett.png" alt="img3" width="80%">
        </div>
        <div class="box">
            <img src="../img/white.png" alt="img4" width="80%">
        </div>
    </div>
    <?php include '../views/footer.php'; ?>

    <!-------------- slick slider link --------------->
    <script>
$(document).ready(function() {
    var currentIndex = 0;
    var slides = $(".slider-item");

    function showSlide(index) {
        slides.hide();
        slides.eq(index).show();
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        showSlide(currentIndex);
    }

    showSlide(currentIndex);

    $(".next").click(function() {
        nextSlide();
    });

    $(".prev").click(function() {
        prevSlide();
    });
});
</script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script2.js"></script>
</body>

</html>