<?php
//----------------------- Database ---------------------------------------------------------------------------
require_once "dbconnect.php";
//----------------------- Database ---------------------------------------------------------------------------

if(isset($_REQUEST['btn_submit']))
{
$name	= strip_tags($_REQUEST['txt_name']);
$cat_id	= strip_tags($_REQUEST['cat_id']);
$description = strip_tags($_REQUEST['txt_des']);
$image =  strip_tags($_REQUEST['image']) ;
$price	= strip_tags($_REQUEST['price']);

if(empty($name)){
$errorMsg[]="Please enter product name";
}
if(empty($cat_id)){
$errorMsg[]="Please enter category id";
}
else if(empty($description)){
$errorMsg[]="Please enter description";
}
else if(empty($price)){
$errorMsg[]="Please enter price";
}
else if(empty($image)){
    $errorMsg[]="Please select image";
}
else
{
try
{

$insert_stmt=$db->prepare("INSERT INTO products( name, cat_id ,description,image,price) VALUES (:uname,:ucat_id,:udescription,:uimage,:uprice)"); 		//sql insert query

if($insert_stmt->execute(array(
':uname'	=>$name,
':ucat_id'=>$cat_id,
':udescription'	=>$description,
':uprice' => $price,
':uimage'=>$image))){

$registerMsg="Add product successful";
}

}
catch(PDOException $e) {
    echo $e->getMessage();
}
}
}
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


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
        background-color: #2f5d62;
        color:#DFEEEA;
    }

    .new_style{
        width:45rem;
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
<nav class="navbar navbar-expand-sm navbar-dark bg-dark justify-content-between">
    <button class="btn btn-sm basket_text_style" name = "btn_profile" onclick="location.href='admin_home.php'">Home</button>
    <button class="btn btn-sm basket_text_style" name = "btn_profile" onclick="location.href='add_user.php'">Add User</button>

    <button class="btn btn-sm basket_text_style" name = "btn_profile" onclick="location.href='add_product.php'">Add Product</button>
</nav>


<?php
if(isset($errorMsg))
{
    foreach($errorMsg as $error)
    {
        ?>

        <div class="alert alert-secondary" role="alert">
            <strong>WRONG ! <?php echo $error; ?></strong>
        </div>
        <?php
    }
}
if(isset($registerMsg))
{
    ?>
    <div class="alert alert-secondary">
        <strong><?php echo $registerMsg; ?></strong>
    </div>
    <?php
}
?>



<div class="card new_style" id ="add_card" style="display: block" >

    <div class="card-header card-header-color  text_color" align="center">
        <H4>ADD NEW PRODUCT</H4>
        <p class="mb-0"> You have to fiil inputs to add new product.</p>
    </div>

    <div class="card-body card-body-color ">
        <form method="post">
            <div class="form-group  text_color">
                <label for="name">Name:</label>
                <input class="form-control" type="name"  id="name" name="txt_name">
            </div>

            <div class="form-group  text_color">
                <label >Category Id:</label>
                <input class="form-control"  name="cat_id">
            </div>

            <div class="form-group  text_color">
                <label for="description">Description:</label>
                <input class="form-control" type="description"  id="description" name="txt_des">
            </div>

            <div class="form-group  text_color">
                <label for="price">Price:</label>
                <input class="form-control" type="price"  id="price" name="price">
            </div>

            <div class="form-group  text_color">
                <label>Image:</label>
                <div class="custom-file">

                    <input type="file" class="custom-file-input" id="customFile" name = "image">
                    <label class="custom-file-label" for="customFile"></label>
                </div>
            </div>
            <div align="center">
                <button class="btn btn-primary cards_button_style" type="submit"  name="btn_submit">SUBMIT</button>
            </div>
        </form>
    </div>

</div>
</div>

</body>
