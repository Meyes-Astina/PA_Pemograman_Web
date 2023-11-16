<?php
    include '../connection/connection.php';
    session_start();
    $user_id= $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location: ../views/login.php');
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header("location: ../views/login.php");
    }
        //adding product in wishlist
        if(isset($_POST['add_to_wishlist'])){
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
    
            $wishlist_number = mysqli_query($conn, "SELECT * FROM  'wishlist' WHERE name= '$product_name' AND user_id= '$user_id'") or die ('query failed');
            $cart_num = mysqli_query($conn, "SELECT * FROM  'cart' WHERE name= '$product_name' AND user_id= '$user_id'") or die ('query failed');
            if(mysqli_num_rows($wishlist_number) > 0){
                $message[]= 'product already exist in wishlist';
            }else if(mysqli_num_rows($cart_num)>0){
                $message[]= 'product already exist in cart';
            }else{
                mysqli_query($conn, "INSERT INTO 'wishlist' ('user_id', 'pid','name','price','image') 
                VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')");
                $message[]= 'product successfully added to wishlist';
            }
    
        }
        //adding product in cart
        if(isset($_POST['add_to_cart'])){
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = $_POST['product_quantity'];
        
            $cart_num = mysqli_query($conn, "SELECT * FROM  cart  WHERE name= '$product_name' AND user_id= '$user_id'") or die ('query failed');
        
            if(mysqli_num_rows($cart_num) > 0){
                $message[] = 'Product already exists in the cart';
            } else {
                mysqli_query($conn, "INSERT INTO cart (user_id, pid, name, price, quantity, image) 
                    VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')");
                $message[] = 'Product successfully added to the cart';
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
    <?php include '../views/header.php';?>
    <div class="banner">
        <div class="detail">
            <h1>product detail</h1>
        </div>
    </div>
    <div class="line"></div>
    <section class="view_page">
      <h1 class="title">shop best sellers</h1>
        <?php 
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message">
                    <span>'.$message.'</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                </div>';
                }
            }
        ?>
       
            <?php 
              if(isset($_GET['pid'])) {
                    $pid = $_GET['pid'];
                    $select_products = mysqli_query($conn, "SELECT * FROM products WHERE id= '$pid'")
                    or die('query failed');
              if(mysqli_num_rows($select_products)>0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){   
                
            ?>
            <form action="post" class="box">
                <img src="../image/<?php echo $fetch_products['image']; ?>" alt="">
                <div class="detail">
                    <div class="price">Rp.<?php echo $fetch_products['price']; ?></div>
                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                    <div class="detail"><?php echo $fetch_products['product_detail']; ?></div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                </div>
            </form>

            <?php 
            
            }
        }
    }
            ?>
        
    </section>
    <?php include '../views/footer.php';?>
    <!-------------- slick slider link --------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>