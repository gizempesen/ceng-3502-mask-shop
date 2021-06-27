
<?php
//----------------------- Database ---------------------------------------------------------------------------
require_once 'dbconnect.php';
//----------------------- Database ---------------------------------------------------------------------------

session_start();

//------------------------------------------------------------------------------------------------------------
if(!isset($_SESSION['user_login'])){
    header("location: login.php");
}
//------------------------------------------------------------------------------------------------------------

if(array_key_exists('btn_profile', $_POST)) {
    header("location: login.php");
}

$id = $_SESSION['user_login'];

$select_stmt = $db->prepare("SELECT * FROM customers WHERE user_id=:uid");
$select_stmt->execute(array(":uid"=>$id));

$row=$select_stmt->fetch(PDO::FETCH_ASSOC);


//---------------------------------------- Add to Cart ---------------------------------------------------------
if(isset($_POST["add_to_cart"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'			=>	$_GET["id"],
                'item_name'			=>	$_POST["hidden_name"],
                'item_price'		=>	$_POST["hidden_price"],
                'item_quantity'		=>	$_POST["quantity"],
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
            echo '<script>alert("Item Already Added")</script>';
        }
    }
    else
    {
        $item_array = array(
            'item_id'			=>	$_GET["id"],
            'item_name'			=>	$_POST["hidden_name"],
            'item_price'		=>	$_POST["hidden_price"],
            'item_quantity'		=>	$_POST["quantity"],
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}

if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>window.location="welcome.php"</script>';
            }
        }
    }
}
//---------------------------------------- Add to Cart ---------------------------------------------------------
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
    .card_style{
        background-color:#DFEEEA;  
        color : #2f5d62;
        margin-top: 50px;
        width:28rem;
        border-radius:5px;
    }
    .table_style{
        width:30rem;
        border-color:#2f5d62 ;
        overflow-x: hidden;
    }

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
        background-color: #2f5d62 ;
        width: available;
        height: 30px;

    }

    .basket_text_style {
        font-size: 15px;
        font-weight: bold;
        color: #DFEEEA;
        vertical-align: center;
        height: 30px;

    }

    .cards_button_style{
        background-color:#2f5d62 ;
        color:#DFEEEA;
    }
    .image_style{
        width: 28rem;
        height: 27rem;

    }

    .buy_button{
        background-color: #DFEEEA;
        color:#2f5d62  ;
    }


    .categories_style{
        color:#bdb2ff ;
        text-align: right;
        font-size: 15px;
        font-weight: bold;
        vertical-align: center;
        border-top: 40px;
          
    }
    .textcenter{
      position: absolute;

      right: 200px;
    }

    .textcenter2{
      position: absolute;

      right: 80px;
    }
    .textcenter3{
      position: absolute;

      left: 50px;
    }

</style>

<body class="background-image ">
<div class="card-title top_border">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
    <div class="textcenter2">
        <button class="btn btn-sm basket_text_style" name = "btn_profile" onclick="location.href='profile.php'">PROFİLE</button>
    </div >
        <form method="post"   >
            <button class="btn btn-sm categories_style" type="submit" name="painting" > N-95</button>
            <button class="btn btn-sm categories_style" type="submit" name="printmaking"  >Black Mask</button>
            <button class="btn btn-sm categories_style"  type="submit" name="photography" > Anime Mask</button>
            <button class="btn btn-sm categories_style"  type="submit" name="drawing"> Couple Mask</button>
            <button class="btn btn-sm categories_style"  type="submit" name="digital_art"> Special</button>
        </form>


        <form class="form-inline" method="post">
            <input class="form-control mr-sm-2" type="search" name = "s_name" placeholder="Search" aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit" name = "search">Search</button>
        </form>

        <div class="textcenter">
            <button class="btn btn-secondary dropdown-toggle  basket_text_style" type="button" style="float: right "id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
            <span class="glyphicon glyphicon-shopping-cart cart-icon ml-3"></span></a>
                BASKET
            </button>

            <div class="dropdown-menu  cards_button_style "  aria-labelledby="dropdownMenuButton">
                <div class="table-responsive table_style">
                    <table class="table table-bordered">
                        <tr>
                            <th width="70%">Name</th>
                            <th width="30%">Price</th>
                        </tr>
                        <?php
                        if(!empty($_SESSION["shopping_cart"]))
                        {
                            $total = 0;
                            foreach($_SESSION["shopping_cart"] as $keys => $values)
                            {
                                ?>
                                <tr>
                                    <td><?php echo $values["item_name"]; ?></td>
                                    <td>$ <?php echo $values["item_price"]; ?></td>
                                </tr>
                                <?php
                                $total = $total + ($values["item_quantity"] * $values["item_price"]);
                            }
                            ?>
                            <tr>
                                <td colspan="1" align="left">Total</td>
                                <td align="left">$ <?php echo number_format($total, 1); ?></td>
                            </tr>

                            <?php
                        }
                        ?>

                    </table>
                </div>

                <div align="center">
                    <button href="#" class="btn btn-secondary buy_button" align="center" onclick="location.href='basket.php'">Buy</button>
                </div>
            </div>

        </div>
    </nav>


</div>

<div class="container " style="margin-top: 60px" ></div>
<?php

if(array_key_exists('painting', $_POST)) {
    $index = 1;
}
else if(array_key_exists('printmaking', $_POST)) {
    $index = 2;
}
else if(array_key_exists('photography', $_POST)) {
    $index = 3;
}
else if(array_key_exists('drawing', $_POST)) {
    $index = 4;
}
else if(array_key_exists('digital_art', $_POST)) {
    $index = 5;
}else{
    $index = 1;
}

$query = "SELECT * FROM products WHERE cat_id = $index  ORDER BY id ASC";



if(isset($_REQUEST['search']))
{
    $name = strip_tags($_REQUEST["s_name"]);
    if(empty($name)){
        echo '<script>alert("Please enter product name!")</script>';
    }
    else
    {
        try {
            $select_stmt = $db->prepare("SELECT * FROM products WHERE name =:uname");
            $select_stmt->execute(array(':uname' => $name));
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if ($select_stmt->rowCount() > 0) {
                if ($name == $row["name"]) {
                    $query = "SELECT * FROM products WHERE name LIKE '%$name%'";
                }
            }else{
                echo '<script>alert("Product not found !")</script>';
            }
        }catch(PDOException $e)
        {
            $e->getMessage();
        }
    }
}


$result = mysqli_query($connect, $query);


if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_array($result))
    {
        ?>
        <div class="col-md-3 " id = "products" style="display: block" align="center">
            <form method="post" action="welcome.php?action=add&id=<?php echo $row["id"]; ?>">
                <div class="card card_style"  >
                    <img class="card-img-top   image_style" src="images/<?php echo $row["image"]; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h4 style="font-weight: bold" ><?php echo $row["name"]; ?></h4>

                        <p><?php echo $row["description"]; ?></p>

                        <h5>$ <?php echo $row["price"]; ?></h5>


                        <input type="text" name="quantity" value="1" class="form-control"  style="width: 40px"/>

                        <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

                        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

                        <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn cards_button_style" value="Add Basket" />
                    </div>
            </form>
        </div>

        </div>

        <?php
    }
}
?>

</body>
<script>
</script>

</html>