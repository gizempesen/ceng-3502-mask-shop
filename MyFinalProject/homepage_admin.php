<?php

require_once 'dbconnect.php';

session_start();
?>

<!DOCTYPE html>
<html lang="en">
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

    .background-image{
        background-color: #ffffff;
        background-repeat: no-repeat;
        background-attachment: fixed;
        position: absolute;
        top:0;
        width: 100%;
        height: 100%;
        background-position: center;
        background-size: cover;
        overflow-x: hidden;
    }

    .card {
        margin: 0 auto;
        float: none;
        margin-bottom: 50px;

    }
    .top_border{
        margin-top: 0px;
        background-color: #2f5d62;
        width: available;
        height: 30px;

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

    .new_style{
        width:30rem;
        height: auto;
        background-color: #DFEEEA;
        margin-top: 60px;
    }

    .text_color{

        font-weight: bold;
        font-family: "Berlin Sans FB Demi";
    }



</style>

<body class="background-image ">
<div class="card-title top_border">


    <div class="dropdown align-content-around " >
        <button class="btn btn-sm basket_text_style" onclick="add_newp()">Add New Painting</button>
        <button class="btn btn-sm basket_text_style" name = "btn_profile" onclick="location.href='profile.php'">PROFİLE</button>
    </div>
</div>

<div class="card new_style" id ="add_card" style="display: none" >

    <div class="card-header card-header-color  text_color" align="center">
        <H4>ADD NEW PAINTING</H4>
        <p class="mb-0"> You have to fiil inputs to add new painting.</p>
    </div>

    <div class="card-body card-body-color ">
        <form>
            <div class="form-group  text_color">
                <label for="name">Name:</label>
                <input class="form-control" type="name"  id="name" name="name">
            </div>

            <div class="form-group  text_color">
                <label for="description">Description:</label>
                <input class="form-control" type="description"  id="description" name="description">
            </div>

            <div class="form-group  text_color">
                <label for="price">Price:</label>
                <input class="form-control" type="price"  id="price" name="price">
            </div>

            <div class="form-group  text_color">
                <label>Image:</label>
                <div class="custom-file">

                    <input type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile"></label>
                </div>
            </div>
            <div align="center">
                <button class="btn btn-primary cards_button_style" type="button"  onclick="submitData()" >SUBMIT</button>
            </div>

        </form>
    </div>

</div>
</div>


<div class="form_box">

    <form action="" method="post" enctype="multipart/form-data">

        <table align="center" width="100%">

            <tr>
                <td colspan="7">
                    <h2>Add Product</h2>
                    <div class="border_bottom"></div>
                </td>
            </tr>

            <tr>
                <td><b>Product Title:</b></td>
                <td><input type="text" name="product_title" size="60" required/></td>
            </tr>

            <tr>
                <td><b>Product Category:</b></td>
                <td>
                    <select name="product_cat">
                        <option>Select a Category</option>

                        <?php
                        $get_cats ="select * from categories";

                        $run_cats = mysqli_query($db, $get_cats);

                        while($row_cats=mysqli_fetch_array($run_cats)){
                            $cat_id = $row_cats['id'];

                            $cat_title = $row_cats['name'];

                            echo "<option value='$cat_id'>$cat_title</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                ?>
                </select>
                </td>

            </tr>

            <tr>
                <td><b>Product Image: </b></td>
                <td><input type="file" name="product_image" /></td>
            </tr>

            <tr>
                <td><b>Product Price: </b></td>
                <td><input type="text" name="product_price" required/></td>
            </tr>

            <tr>
                <td valign="top"><b>Product Description:</b></td>
                <td><textarea name="product_desc"  rows="10"></textarea></td>
            </tr>

            <tr>
                <td></td>
                <td colspan="7"><input type="submit" name="insert_post" value="Add Product"/></td>
            </tr>
        </table>

    </form>

</div>

<?php

require_once "dbconnect.php";

if(isset($_POST['insert_post'])){
    $product_title = $_POST['name'];
    $product_cat = $_POST['cat_id'];
    $product_price = $_POST['price'];
    $product_desc = trim(mysqli_real_escape_string($db,$_POST['description']));

    $product_image  = $_FILES['image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];

    move_uploaded_file($product_image_tmp,"product_images/$product_image");

    $insert_product = " insert into products (cat_id,name,description,image,price) values ('$product_cat','$product_title','$product_price','$product_desc','$product_image') ";

    $insert_pro = mysqli_query($db, $insert_product);

    if($insert_pro){
        echo "<script>alert('Product Has Been inserted successfully!')</script>";

    }

}else{
    echo "not";
}
?>


</body>
</html>