<?php   require_once ('../config/database.php');
        require_once ('../models/orderModel.php');
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
<body onload="checked('deliver');">
<div class="header">
            <div class="logo">
                 <img src="../resource/img/logo.png" alt="">
                <h1><small style="font-size: 14px; color:white;">   Solution for many problems</small></h1>
            </div>
            <h2><i class="fas fa-tasks"></i> ORDER MANAGER</h2>
            <h5>State : <span>Active</span></h5>
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
        <?php include 'orderSide.php' ?>  
        <?php 
         $records=unserialize($_GET['record']);
         if(!empty($records))
         {
         ?>      
        <div class="accept">
            <div class="title">
                <h3>Delivering Orders </h3>
                <?php 
              
                    foreach($records as $record)
                    {?>
                     <div class="box ">
                            <div class="resend receiving">
                                    <div class="right"><i class="fas fa-motorcycle fa-2x"></i></div>
                                    <div class="letter"><h4>Deliver this order </h4></div>
                            </div>
                            <div class="details-box">
                                    <div class="details">
                                        <h2>Order Id :<span style="color:sienna;"><?php echo $record['order_id']; ?></h2>
                                        <h4 class="order_item"><i class="fas fa-caret-right"></i> Order Item :</h4>
                     <?php   $getOrder=orderModel::getOrderFoodSupplier($connection,$record['order_id'],3);
                        while($result=mysqli_fetch_assoc($getOrder))
                        {
                            echo '<div class="product_item"><h5 class="item">'.$result['product_name'].'</h5>';
                            echo '<h5 class="quantity">Quantity :'.$result['quantity'].'</span></h5></div>';
                            $address=$result['address'];
                            $email=$result['email'];
                            $first_name=$result['first_name'];
                            $last_name=$result['last_name'];
                            $total=$result['total'];
                            $phone=$result['phone'];
                            $method=$result['method'];
                            $order_id=$result['order_id'];
                        }?>
            
                                        <h4  class="order_item"><i class="fas fa-caret-right"></i> Pay amount :<span style="color: red;"> RS <?php echo $total; ?></h4>
                                        
                                    </div>
                                <div class="button-pay">
                                <h4 class="order_item"><i class="fas fa-caret-right"></i> Customer Name : <span style="color: sienna;"><?php echo $first_name; ?></span></h4>
                                <h4 class="order_item"><i class="fas fa-caret-right"></i> Delivery address :<span style="color: sienna;"><?php echo $address; ?></span></h4>
                                <h4 class="order_item"><i class="fas fa-caret-right"></i> Phone number :<span style="color: sienna;"><?php echo $phone; ?></span></h4>
                                <h4 class="order_item"><i class="fas fa-caret-right"></i> Customer will pay for this order in : <span style="color: red;"><?php echo $method; ?></span></h4>
                                <h4  class="order_item" style="border-top: 2px solid rgb(176, 175, 177);font-weight:lighter"><i class="fas fa-check-square"></i> If you delivered this order. Please confirm this order</h4>
                                <button onclick='if(confirm("Confirm that you get the order ?")) window.location="../controller/orderCon.php?orderConfirmFS_id=<?php echo $order_id; ?>"'  type="button" class="btn1 "> Confirm </button>
                            </div>
                            </div>
                    
                         </div>
                <?php    }
                ?>                
            </div>
        </div>
        <?php }
        else{?>
            <div class="empty">
                <h1> Nothing to show here</h1>
            </div>
      <?php  }?>
        </div>
    </div>
    <!-- <?php include 'footer.php'?> -->
</body>
<script src="../resource/js/timing.js"></script>
</html>