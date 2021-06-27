<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mask Shop</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<style>

    .card {
        margin: 0 auto;
        float: none;
        margin-bottom: 50px;

    }
    .top_border{
        margin-top: 0px;
        background-color: #2f5d62;
        width: available;

    }

    .basket_text_style {
        text-align: right;
        font-size: 15px;
        font-weight: bold;
        color: #DFEEEA;
        vertical-align: center;
        height: 30px;
    }

    .cards_button_style{
        background-color:#2f5d62;
        color:#DFEEEA;
    }


    .reg_style{
        width:40rem;
        height: auto;
        background-color: #DFEEEA;
        margin-top: 25px;
    }

    .text_color{
        font-weight: bold;
        font-family: "Berlin Sans FB Demi";
        color: #2f5d62;
    }
    .text_body{
        color: #2f5d62;
        font-weight: bold;
    }
</style>



<?php

require_once "dbconnect.php";

$edit_product = mysqli_query($connect,"select * from products where id='$_GET[id]' ");

$fetch_edit = mysqli_fetch_array($edit_product);
?>

<body class = "background-image">
<nav class="navbar navbar-expand-sm navbar-dark bg-dark  justify-content-between">
    <button class="btn btn-sm basket_text_style" name = "btn_profile" onclick="location.href='admin_home.php'">Home</button>
    <button class="btn btn-sm basket_text_style" name = "btn_profile" onclick="location.href='add_user.php.php'">Add User</button>

    <button class="btn btn-sm basket_text_style" name = "btn_profile" onclick="location.href='add_product.php'">Add Product</button>
</nav>

<div class="container" style="margin-top: 50px"></div>
<div class="row">
    <div class="col">
        <div class="col">

            <div class="card reg_style">

                <div class="card-header card-header-color text_color" align="center">
                    <H4 >EDIT PRODUCT</H4
                    <p class="mb-0"> You can change inputs to update product.</p>
                </div>

                <div class="card-body card-body-color text_body" >
                    <form  method = "post">
                        <div class="form-group" >
                            <label >Product Name</label>
                            <input class="form-control" type="text"  name="name" value= "<?php echo $fetch_edit['name'];?>"
                        </div>
                        <div class="form-group" style="margin-top: 25px">
                            <label>Category</label>

                            <select name="category">
                                <option>Select a Category</option>

                                <?php
                                $get_cats ="select * from categories";

                                $run_cats = mysqli_query($connect, $get_cats);

                                while($row_cats=mysqli_fetch_array($run_cats)){
                                    $cat_id = $row_cats['id'];

                                    $cat_title = $row_cats['name'];

                                    if($fetch_edit['cat_id'] == $cat_id){
                                        echo "<option value='$fetch_edit[category]' selected>$cat_title</option>";

                                    }else{
                                        echo "<option value='$cat_id'>$cat_title</option>";

                                    }
                                }
                                ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label >Description</label>
                            <input class="form-control" type="text"  name="description" value="<?php echo $fetch_edit['description'];?>">
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input class="form-control" name ="price" value="<?php echo $fetch_edit['price'];?>">
                        </div>

                        <div class="form-group">
                            <label >Image</label>
                            <input type="file" class="form-control-file" name="image">
                            <img src="images/<?php echo $fetch_edit['image']; ?>" width="150" height="200"/>
                        </div>
                        <div align="center">
                            <input type="submit" name="edit_product" class="btn cards_button_style" value="Save"/>
                        </div>

                    </form>
                </div>

            </div>
        </div>

        <div class="col"></div>

    </div>

    <?php

    if(isset($_POST['edit_product'])){
        $name = trim(mysqli_real_escape_string($connect,$_POST['name']));
        $category = $_POST['category'];
        $price = $_POST['price'];
        $description = trim(mysqli_real_escape_string($connect,$_POST['description']));

        $image  = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        if(!empty($_FILES['image']['name'])){

            if(move_uploaded_file($image_tmp,"images/$image")){

                $update_product = mysqli_query($connect,"update products set cat_id='$category', name='$name', price='$price',description='$description',image='$image' where id='$_GET[id]' ");
            }

        }else{
            $update_product = mysqli_query($connect,"update products set cat_id='$category', name='$name', price='$price', description ='$description' where id='$_GET[id]' ");

        }

        if($update_product){
            echo "<script>alert('Product was updated successfully!')</script>";
            echo "<script>window.open(window.location.href,'_self')</script>";
        }
    }
    ?>

</body>
