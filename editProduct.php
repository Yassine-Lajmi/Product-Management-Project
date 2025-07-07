<?php
    $con = mysqli_connect("localhost","root","","product management");
    if(isset($_GET['id'])){
        $isToEdit = $_GET['id'];
        $result = mysqli_query($con, "SELECT * FROM `product-management` WHERE id = '$isToEdit'");
        if (mysqli_num_rows($result) > 0){
        $product = mysqli_fetch_assoc($result);
        }else{
        $message = "Product not found";}
    }else{
    $message = "No product selected to edit.";
    }

    if(isset($_POST['editBtn'])){
        $newName = $_POST['name'];
        $newPrice = $_POST['price'];
        if(!empty($newName) && !empty($newPrice)){
            if($newName != $product['prodname']){
                $verif = mysqli_query($con, "SELECT prodname FROM `product-management` WHERE prodname = '$newName'");
                if (mysqli_num_rows($verif) > 0){
                    $message = '<p>Product exists already!</p>';
                }else{   
                    $edit = mysqli_query($con, "UPDATE `product-management` SET prodname='$newName', price='$newPrice' WHERE id='$isToEdit'");
                    if($edit){
                        //$message="Product Updated successfully!";
                        header("Location: index.php");
                    }else{
                        $message="Failed to update product!";
                    }
                }
            }else{   
                $edit = mysqli_query($con, "UPDATE `product-management` SET prodname='$newName', price='$newPrice' WHERE id='$isToEdit'");
                if($edit){
                    //$message="Product Updated successfully!";
                    header("Location: index.php");
                }else{
                    $message="Failed to update product!";
                }
            }}else{
            $message="Please fill out the form!";
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!--<a href="index.php" class="back">Back to Menu</a>-->
    <div class="addForm">
        <h2>Edit a Product</h2>
        <form  class="addProd" method="post" action="#">
            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo $product['prodname'] ?>">
            </div>
            <div class="field">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" value="<?php echo $product['price'] ?>">
            </div>
            <div class="message">
                <?php if(isset($message)){echo $message;} ?>
            </div>
            <div class="actionInput">
                <button class="saveBtn" name="editBtn">Edit</button>
                <a href="index.php" class="cancelBtn">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>