<?php
//----------------------- Database ---------------------------------------------------------------------------
require_once 'dbconnect.php';
//----------------------- Database ---------------------------------------------------------------------------

session_start();

//----------------------- Basket -----------------------------------------------------------------------------
if (isset($_POST["add_to_cart"])) {
    if (isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if (!in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'            =>    $_GET["id"],
                'item_name'            =>    $_POST["hidden_name"],
                'item_price'        =>    $_POST["hidden_price"],
                'item_quantity'        =>    $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        } else {
            echo '<script>alert("Item Already Added")</script>';
        }
    } else {
        $item_array = array(
            'item_id'            =>    $_GET["id"],
            'item_name'            =>    $_POST["hidden_name"],
            'item_price'        =>    $_POST["hidden_price"],
            'item_quantity'        =>    $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            if ($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>window.location="basket.php"</script>';
            }
        }
    }
}
//----------------------- Basket ----------------------------------------------------------------------------


//----------------------- Basket Remove ---------------------------------------------------------------------
if (array_key_exists('clear', $_POST)) {
    $_SESSION["shopping_cart"] = array();
    echo '<script>window.location="welcome.php"</script>';
}
//----------------------- Basket Remove --------------------------------------------------------------------
?>
<?php
//----------------------- Credit Cart ----------------------------------------------------------------------
if(isset($_REQUEST['btn_credit_card']))
{
    $address	= strip_tags($_REQUEST['inputAddress']);
    $cardnumber	= strip_tags($_REQUEST['inputCardNumber']);
    $cardholdername		= strip_tags($_REQUEST['inputCardHolderName']);
    $date	= strip_tags($_REQUEST['inputDate']);
    $cvv	= strip_tags($_REQUEST['inputCVV']);

    if(empty($address)){
        $errorMsg[]="Please enter product name";
        }
        if(empty($cardnumber)){
        $errorMsg[]="Please enter category id";
        }
        else if(empty($cardholdername)){
        $errorMsg[]="Please enter description";
        }
        else if(empty($date)){
        $errorMsg[]="Please enter price";
        }
        else if(empty($cvv)){
            $errorMsg[]="Please select image";
        }
        else
        {
        try
        {
        
        $insert_stmt=$db->prepare("INSERT INTO creditcard( address, cardnumber ,cardholdername,date,cvv) VALUES (:uaddress,:ucardnumber,:ucardholdername,:udate,:ucvv)"); 		//sql insert query
        
        if($insert_stmt->execute(array(
        ':uaddress'	=>$address,
        ':ucardnumber'=>$cardnumber,
        ':ucardholdername'	=>$cardholdername,
        ':udate' => $date,
        ':ucvv'=>$cvv))){
        
        $registerMsg="  successful";

        }
        
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
        }
        }
//----------------------- Credit Cart ----------------------------------------------------------------------        
?>

<?php
//----------------------- Wire -----------------------------------------------------------------------------
if(isset($_REQUEST['btn_wire']))
{
    $address	= strip_tags($_REQUEST['inputAddress']);
    $accountname	= strip_tags($_REQUEST['inputAccountName']);
    $accountnumber		= strip_tags($_REQUEST['inputAccountNumber']);
    $bankname	= strip_tags($_REQUEST['inputBankName']);
    $iban	= strip_tags($_REQUEST['inputIBAN']);

    if(empty($address)){
        $errorMsg[]="Please enter address";
        }
        if(empty($accountname)){
        $errorMsg[]="Please enter accountname ";
        }
        else if(empty($accountnumber)){
        $errorMsg[]="Please enter accountnumber";
        }
        else if(empty($bankname)){
        $errorMsg[]="Please enter bankname";
        }
        else if(empty($iban)){
            $errorMsg[]="Please enter iban ";
        }
        else
        {
        try
        {
        
        $insert_stmt=$db->prepare("INSERT INTO wire( address, accountname ,accountnumber,bankname,iban) VALUES (:uaddress,:uaccountname,:uaccountnumber,:ubankname,:uiban)"); 		//sql insert query
        
        if($insert_stmt->execute(array(
        ':uaddress'	=>$address,
        ':uaccountname'=>$accountname,
        ':uaccountnumber'	=>$accountnumber,
        ':ubankname' => $bankname,
        ':uiban'=>$iban))){
        
        $registerMsg="  successful";
        }
        
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
        }
        }
//----------------------- Wire  ----------------------------------------------------------------------        
?>

<!------------------------ Head ---------------------------------------------------------------------->
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>

<!------------------------ Head ---------------------------------------------------------------------->

<!------------------------ Style ---------------------------------------------------------------------->
<style>
    .table_style {
        width: 54rem;

    }

    .background-image {
        background-color: #ffffff;
        background-repeat: no-repeat;
        background-attachment: fixed;
        position: absolute;
        top: 0;
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

    .top_border {
        margin-top: 0px;
        background-color: #2f5d62;
        width: available;


    }

    .basket_text_style {

        font-size: 15px;
        font-weight: bold;
        color: #DFEEEA;
        vertical-align: center;
        height: 30px;

    }

    .payment_card_style {

        width: 57rem;
        height: auto;
        background-color: #DFEEEA;

    }

    .payment_header_text {

        font-family: "Berlin Sans FB Demi";
        font-size: 30px;
        color: #2f5d62;
        text-align: center;
        font-weight: bolder;
    }

    .payment_menu {
        margin-top: 10px;
        margin-bottom: 10px;
        height: auto;
    }

    .payment_buttons {
        text-align: center;
        background-color: #2f5d62;
        width: 150px;
        height: auto;
        color: #DFEEEA;
    }

    .approve_style {
        background-color: #2f5d62;
        color:#DFEEEA;
        margin-bottom: 35px;
    }

    .text_color {
        font-weight: bold;
        font-family: "Berlin Sans FB Demi";
    }
</style>
<!------------------------ Style ---------------------------------------------------------------------->

<body class="background-image ">
    <div class="card-title top_border">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark  justify-content-between">
            <button class="btn btn-sm basket_text_style" name="btn_profile" onclick="location.href='profile.php'">PROFILE</button>
            <button class="btn btn-sm basket_text_style" name="btn_profile" onclick="location.href='welcome.php'">HOME</button>
        </nav>

</div>

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

<!------------------------ Basket Show ---------------------------------------------------------------------->
    <div class="container " style="margin-top: 60px"></div>

    <div class="card payment_card_style " style="display: block" id="basket_card">

        <div class="card-header">
            <h2 class="payment_header_text "> BASKET</h2>
        </div>

        <div class="card-body  ">

            <div class="table-responsive table_style">
                <table class="table table-bordered" align="center">
                    <tr>
                        <th width="40%">Item Name</th>
                        <th width="10%">Quantity</th>
                        <th width="20%">Price</th>
                        <th width="15%">Total</th>
                        <th width="5%">Action</th>
                    </tr>
                    <?php
                    if (!empty($_SESSION["shopping_cart"])) {
                        $total = 0;
                        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                    ?>
                            <tr>
                                <td><?php echo $values["item_name"]; ?></td>
                                <td><?php echo $values["item_quantity"]; ?></td>
                                <td>$ <?php echo $values["item_price"]; ?></td>
                                <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                                <td><a href="basket.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
                            </tr>
                        <?php
                            $total = $total + ($values["item_quantity"] * $values["item_price"]);
                        }
                        ?>
                        <tr>
                            <td colspan="3" align="right">Total</td>
                            <td align="right">$ <?php echo number_format($total, 2); ?></td>
                            <td></td>
                        </tr>
                    <?php
                    }
                    ?>

                </table>
            </div>

<!------------------------ Basket Show ---------------------------------------------------------------------->


<!------------------------ Payment Type ---------------------------------------------------------------------->
<form id="payment" style="display: none" method="post">
                <p class="card-title text_color" style="text-align: center">PAYMENT</p>
                <label class="text_color" for="payment_option">Payment Option:</label>
                <select onchange="yesnoCheck(this); wireCheck(this);" class="card form-control payment_menu" id="payment_option">
                    <option value="wire">Choose an Option</option>
                    <option value="credit">Credit Card</option>
                    <option value="wire">Wire Transfer</option>
                </select>
<!------------------------ Payment Type ---------------------------------------------------------------------->

</form>

<!------------------------  Checkout  ------------------------------------------------------------------------->

<!------------------------  Cart  ----------------------------------------------------------------------------->
            <form method = "post">
            <form id="ifYes" style="display: none;" onsubmit="return false"> <span id="card-header"></span>
            <p class="card-title text_color" style="text-align: center">Credit Card</p>
                <div class="form-group">
                    <label class="text_color" for="inputaddress">Address:</label>
                    <input type="text" class="form-control" name = 'inputAddress' placeholder="Please Enter Your Address">
                </div>    

                <div class="form-group">
                    <label class="text_color" for="inputcardnumber">Card Number </label>
                    <input type="text" class="form-control" name = 'inputCardNumber' placeholder="**** **** **** 3193">
                </div>

                <div class="form-group">
                    <label class="text_color" for="inputcardholdername">Cart Holder Name</label>
                    <input type="text" class="form-control" name = 'inputCardHolderName' placeholder="Name Surname">
                </div class="form-group"> 
                    <input type="text" class="form-control" name = 'inputDate' placeholder="Exp. date">
                    <input type="text" class="form-control" name = 'inputCVV' placeholder="CVV">

                <form id="ifYes" style="display: none;" onsubmit="return false" method="post"><span id="card-header"></span>
                    <div align="center">
                        <button class="btn btn-sm approve_style " type="submit" name="btn_credit_card">Approve</button>
                    </div>
                </form>

            </form>
        </form>
<!------------------------  Cart  ------------------------------------------------------------------------->
            
<!------------------------  Wire  ------------------------------------------------------------------------->
<form method = "post">
            <form id="ifWire" style="display: none;" onsubmit="return false"> <span id="card-header"></span>
            <p class="card-title text_color" style="text-align: center"> Wire Transfer</p>
                <div>
                    <label class="text_color" for="inputAddress">Address:</label>
                    <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Please Enter Your Address">
                </div>
                <div>
                    <label class="text_color" for="inputAccountName">Account Name</label>
                    <input type="text" class="form-control" name = 'inputAccountName' placeholder="Enter account name">
                </div>    
                <div>
                    <label class="text_color" for="inputAccountNumber">Account Number</label>
                    <input type="text" class="form-control" name ="inputAccountNumber" placeholder="Enter account number">
                </div>

                <div>
                    <label class="text_color" for="inputBankName"> Bank Name</label>
                    <input type="text" class="form-control" name = "inputBankName" placeholder="Enter bank name">
                </div>

                <div >
                    <label class="text_color" for="inputIBAN">IBAN</label>
                    <input type="text" class="form-control" name = "inputIBAN" placeholder="AL47 2121 1009 0000 0002 3569 87411﻿">
                </div>

                <form id="ifWire" style="display: none;" onsubmit="return false" method="post"><span id="card-header"></span>
                    <div align="center">
                        <button class="btn btn-sm approve_style " type="submit" name="btn_wire" >Approve</button>
                    </div>
                </form>
            </form>
</form>
<!------------------------  Wire  ------------------------------------------------------------------------->

<!------------------------  Checkout  --------------------------------------------------------------------------------->

<!------------------------ Payment Buttons --------------------------------------------------------------->
            <div align="center">
                <a href="#" class="btn  btn-sm payment_buttons " id="buy" onclick="buy1()">Checkout</a>
                <a href="#" class="btn btn-sm  payment_buttons " onclick="go_shopping()">Go Shopping</a>
            </div>
<!------------------------ Payment Option --------------------------------------------------------------->

        </div>

    </div>

<!------------------------ Script  ---------------------------------------------------------------------->
    <script>
        function approvef() {


        //    var x = document.getElementById("inputAddress").value;
        //    if (x == null || x == "") {
        //        alert("Address must be filled out");

        //    } else {
                alert("Your order has been received");
                location.href = 'welcome.php';

                var a = document.getElementById("payment");
                if (a.style.display === "block") {
                    a.style.display = "none";

                }

            }
        //}

        function go_shopping() {
            var z = document.getElementById("payment");
            if (z.style.display === "block") {
                z.style.display = "none";
            }
            location.href = 'welcome.php';
        }

        function buy1() {
            document.getElementById("buy").disabled = true;
            var a = document.getElementById("payment");
            if (a.style.display === "none") {
                a.style.display = "block";
            }

        }

        function yesnoCheck(that) {
            if (that.value == "credit") {
                document.getElementById("ifYes").style.display = "block";
            } else {
                document.getElementById("ifYes").style.display = "none";
            }
        }

        function wireCheck(that) {
            if (that.value == "wire") {
                document.getElementById("ifWire").style.display = "block";
            } else {
                document.getElementById("ifWire").style.display = "none";
            }
        }

        function JSalert() {

            swal({
                text: "Your order has been received",
                type: "success",
                timer: 3000
            });

        }
    </script>
<!------------------------ Script  ---------------------------------------------------------------------->

</body>

</html>