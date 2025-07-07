<?php 
if(isset($_POST['saveBtn'])){
    $con = mysqli_connect("localhost","root","","product management");
    $name = $_POST['name'];
    $price = $_POST['price'];
    if(!empty($name) && !empty($price)){
        $verif = mysqli_query($con, "SELECT prodname FROM `product-management` WHERE prodname = '$name'");
        if (mysqli_num_rows($verif) > 0){
            $message = '<p>Product exists already!</p>';
        }else{
            $save = mysqli_query($con, "INSERT INTO `product-management` VALUES(0,'$name','$price')");
            if($save){
                $message = '<p>Product Added successfully!</p>';
            }else{
                $message = '<p>Product not Added!</p>';
            }
        }
    }else{
        $message = '<p>Please fill out the form!</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php" class="back">Back to Menu</a>
    <div class="addForm">
        <h2>Add a Product</h2>
        <form  class="addProd" method="post" action="">
            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="field">
                <label for="price">Price</label>
                <input type="text" id="price" name="price">
            </div>
            <div class="message">
                <?php
                if(isset($message)){
                    echo $message;
                }
                ?>
            </div>
            <div class="actionInput">
                <button class="saveBtn" name="saveBtn">Save</button>
                <a href="index.php" class="cancelBtn">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>