<?php   require_once ('../config/database.php');
        require_once ('../models/reg_user.php');
        session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resource/css/nav.css">
    <link rel="stylesheet" href="../resource/css/paymentFoodSlide.css">
    <link rel="stylesheet" href="../resource/css/all.css">
    <link rel="stylesheet" href="../resource/css/paymentFood.css">
    <title>Document</title>
</head>
<body onload="checked('accept');">
<div class="header">
            <div class="logo">
                 <img src="../resource/img/logo.png" alt="">
                <h1><small style="font-size: 14px; color:white;">   Solution for many problems</small></h1>
            </div>
            <h2><i class="fas fa-tasks"></i> ORDER-REQUEST MANAGER</h2>
            
            <div class="sign">
                <?php if(isset($_SESSION['email'])){ 
                    ?>

                    <div class="notification">
                        <i class="fa fa-bell fa-lg"></i>
                        <div class="notification-box" >
                            <ul>
                                <li><i class="fas fa-times fa-2x"></i></li>
                                <a href="#"><li>You have notification</li></a>
                                <a href="#"><li>You have notification</li></a>
                                <a href="#"><li>You have notification</li></a>
                                <a href="#"><li>You have notification</li></a>
                                <a href="#"><li>You have notification</li></a>
                            </ul>
                        </div>
                    </div>
                    <div class="profile"><a href="profilepage.php"> <i  class="fa fa-user-circle fa-lg"></a></i></div>
                <?php
                    echo '<div class="user"><h4>Welcome '.$_SESSION['first_name'].'</h4></div>'; ?>
                    <button onclick="window.location='../controller/logoutController.php'">Sign out <i class="fa fa-sign-out-alt"></i></button>
                <?php } ?>
                
            </div>
        </div>
    <div class="container">
        <div class="content">
        <?php include  'paymentFoodSlide.php';?>  
        <?php
            $ids=unserialize($_GET['ids']);
            $data_rows=unserialize($_GET['data_rows']);
            if(!empty($ids))
            {
       ?>         
        <div class="accept">
            <div class="title">
                <h3>Order accepted </h3>
               <?php
                 $total='';
                $ids=unserialize($_GET['ids']);
                $data_rows=unserialize($_GET['data_rows']);
                $i=1;
                foreach($ids as $id){
                ?>
                <div class="box">
                <div class="resend">
                        <div class="right"><i class="fa fa-check fa-2x"></i></div>
                        <div class="letter"><h4>Your order is accepted <small ><b style="color: red;" ></b> This order will cancel </small></h4></div>
                    </div>
                  <div class="details-box">
                         <div class="details">
                            <h2>Order Id :<span style="color:sienna;"><?php echo $id; ?></h2>
                            <h4 class="order_item"><i class="fas fa-caret-right"></i> Order Item :</h4>
                            <?php
                                   foreach($data_rows as $data_row)
                                   {
                                       if($data_row['order_id']==$id)
                                       {
                                           $total=$data_row['total'];
                                           $time=$data_row['time'];
                                           $restaurant=$data_row['restaurant'];
                                           echo '<div class="product_item"><h5 class="item">'.$i++.'.'.$data_row['product_name'].'</h5>';
                                           echo '<h5 class="quantity">Quantity :'.$data_row['quantity'].'</h5></div>';
                                       }
                                           
                                   }
                                   $i=1;
                            ?>
                            <h4 class="order_item">Pay amount :<span style="color: red;"> RS <?php echo $total; ?></span></h4>
                        </div>
                        <div class="button-pay ">
                        <h4 class="order_item"><i class="fas fa-caret-right"></i> Ordered time : <span style="color: sienna;"><?php echo $time ?></span> </h4>
                        <h4 class="order_item"><i class="fas fa-caret-right"></i> Resturent  : <span style="color: sienna;"><?php echo $restaurant ?></span> </h4>
                            <h4 class="order_item" style="border-top: 2px solid rgb(176, 175, 177);font-weight:lighter" ><i class="fas fa-dollar-sign"></i> Please pay your order !</h4>
                            <form class="form1" method="post" action="https://sandbox.payhere.lk/pay/checkout">
                                <button><i class="fas fa-wallet"></i> Pay Card</button>
                                <input type="hidden" name="merchant_id" value="1215562">    <!-- Replace your Merchant ID -->
                                <input type="hidden" name="return_url" value="http://localhost/bodima-app/controller/orderCon.php"> 
                                <input type="hidden" name="cancel_url" value="http://localhost/mvc/application/views/sucsses.php">
                                <input type="hidden" name="notify_url" value="http://localhost/mvc/application/config/payCon.php">  
                                <input type="hidden" name="order_id" value="<?php echo $id ?>">
                                <input type="hidden" name="items" value="siri niwasa"><br>
                                <input type="hidden" name="currency" value="LKR">
                                <input type="hidden" name="amount" value="<?php echo $total; ?>">  
                                <input type="hidden" name="first_name" value="<?php echo $_SESSION['first_name'];?>">
                                <input type="hidden" name="last_name" value="<?php echo $_SESSION['last_name'];?>"><br>
                                <input type="hidden" name="email" value="<?php echo $_SESSION['email'];?>">
                                <input type="hidden" name="phone" value="0771234567"><br>
                                <input type="hidden" name="address" value="No.1, Galle Road"> 
                                <input type="hidden" name="city" value="Colombo">
                                <input type="hidden" name="country" value="Sri Lanka"><br><br> 
                            </form>
                        </div>
                  </div>
                    
                </div>
                <?php
            }
                ?>
            </div>
        </div>
        <?php 
            }
            else
            {?>
                <div class="empty">
                <h1> Nothing to show here</h1>
            </div>
         <?php
            }
        ?>
    
        </div>
    </div>
    <!-- <?php include 'footer.php'?> -->
</body>
<script src="../resource/js/timing.js"></script>
</html>