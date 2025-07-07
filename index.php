<?php
     $con = mysqli_connect("localhost","root","","product management");
    if(isset($_GET['searchBar'])){
        $searchTerm = mysqli_real_escape_string($con, $_GET['searchBar']);
        $query = "SELECT * FROM `product-management` WHERE prodname LIKE '%$searchTerm%'";
    }else{
        $query = "SELECT * FROM `product-management`";
    }
    $show=mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>Product Management Web App</h1></header>
        <div class="content">
        <div class="header">
            <h2>List of Products</h2>
            <form action="" method="get"> 
                <input type="text" name="searchBar" placeholder="Search a product" value="<?php echo $searchTerm ?>" autofocus>
                <button name="searchBtn"><img src="images/searchButton.png" alt="Search" height="40px" width="40px"></button>
            </form>
            <a href="addProduct.php"><img src="images/addButton.png" alt="Add a product" height="50px" width="50px"></a>
        </div>
        <div class="list">
            <?php
                if(isset($_POST['deleteBtn'])){
                    $isToDelete = $_POST['deleteId'];
                    $con = mysqli_connect("localhost","root","","product management");
                    $delete = mysqli_query($con, "DELETE FROM `product-management` WHERE id = '$isToDelete'");
                    if($delete){
                        echo"<p>Product successfully deleted!</p>";
                    }else{
                        echo"<p>Product not deleted!</p>";
                    }
                }
            ?>
            <table>
                <tr>
                    <th class="id">Id</th>
                    <th class="name">Name</th>
                    <th class="price">Price</th>
                    <th colspan="2" class="action">Action</th>
                </tr>
                <?php
                    //$con = mysqli_connect("localhost","root","","product management");
                    //$show = mysqli_query($con, "SELECT * FROM `product-management`");
                    if(mysqli_num_rows($show) == 0){
                        echo'<tr><td colspan="5">No Products available</td></tr>';
                    }else{
                        while($row = mysqli_fetch_assoc($show)){
                        echo'
                        <tr>
                            <td class="id">'.$row['id'].'</td>
                            <td class="name">'.$row['prodname'].'</td>
                            <td class="price">'.$row['price'].'</td>
                            <td class="btn edit"><a href="editProduct.php?id='.$row['id'].'"><img src="images/editButton.png" alt="Edit product" height="40px" width="40px"></a></td>
                            <td class="btn delete"><form method="post" action=""><input type="hidden" name="deleteId" value="'.$row['id'].'"><button name="deleteBtn"><img src="images/deleteButton.png" alt="Delete product" height="40px" width="40px"></button></form></td>
                        </tr>'; 
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>