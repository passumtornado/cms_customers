<?php
session_start();
if(!isset($_SESSION['customer'])&& !isset($_SESSION['cID'])){
    
   header("location: login.php");
}


include "includes/db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>MPB CANTEEN</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div class="brand">MPB Canteen</div>
<div class="address-bar">UENR | SUNYANI-FIAPRE | BREKUM ROAD</div>
<!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">MPB CANteen</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li >
                        <a  href="index.php" ><span class="glyphicon glyphicon-home"></span>Home</a>
                    </li>
                    <li>
                        <a href="about.html"><span class="glyphicon glyphicon-user"></span>About</a>
                    </li>
                    <li>
                        <a href="contact.html"><span class="glyphicon glyphicon-phone"></span>Contact</a>
                    </li>
                    <li>
                        <a class="active" href="myproduct.php" id="login"><span class="glyphicon glyphicon-modal-window"></span>products</a>
                    </li>
                     <li class="dropdown">
                        <a href="index.php?source=signup" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo " <span style='font-size:12; text-transform: lowercase ! important;'>Hi {$_SESSION['customer']} </span>
                              ";?><span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="customer_cart_edit.php"><span class="glyphicon glyphicon-shopping-cart"></span>MyCart</a></li>
                             <li class="divider" role="separator"></li>
                             <li><a href="#"><span class="glyphicon glyphicon-shopping-user"></span>Profile</a></li>
                              <li class="divider" role="separator"></li>
                             <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                        </ul>
                            
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
     
    
        <div class="container">

        <div class="row">
           
            <div class="col-md-3">
                <form method="post" action=" ">
                    <div class="input-group">
                        <input name="search_menu" id="search" type="text" class="form-control" placeholder="search for...">
                        <span class="input-group-btn"><button class="btn btn-success" id="search_button">G0!</button></span>
                    </div>
                </form>
                <p><br/></p>
                <div class="row">
                    <div class="col-md-12">
                        <div id="get_category">
                        
                        </div>
                        
              <!--  <p class="lead"><a href="product.php?source=menu">MENU</a></p>
                <div class="list-group">
                    <a href="product.php?source=breakfast" class="list-group-item">Breakfast</a>
                    <a href="product.php?source=lunch" class="list-group-item">Lunch</a>
                    <a href="product.php?source=supper" class="list-group-item">Supper</a>
                    <a href="#" class="list-group-item">Combo</a>
                </div>-->
                    </div> 
                </div>
               
                <div class="row">
                 <p class="lead"><a href="#" id="product1">SPECIAL OFFERS</a></p>
                    <div class="col-md-12">
                         <div class="list-group">
                    
                    <a href="#" class="list-group-item" id="event_form">Event</a>
                    <a href="#" class="list-group-item">Snacks</a>
                </div>
                        
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                      <div class="panel panel-success">
                          <div class="panel-heading">MENU</div>
                          <div class="panel-body">
                             
                              <div id="get_myform">
                                   <div class="row">
                              <div class="col-md-12">
                                  <div class="panel panel-success">
                                  <div class="panel-heading"><h2 class="text-center">Notes</h2></div>
                                      <div class='panel-body'>
                                      
                                     <table  class='table table-bordered table-hover'>
                                          <thead>
                                          <tr>
                                              <th>Packages</th>
                                               <th>Range</th>
                                               <th>Price</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>Fried Rice and chicken</td>
                                                <td>20-50</td>
                                                 <td>&#8373 8</td>
                                              </tr>
                                              <tr>
                                              <td>Fried Rice and Tilapia</td>
                                                <td>20-50</td>
                                                 <td>&#8373 9</td>
                                              </tr>
                                              <tr>
                                              <td>Jollof rice and chicken</td>
                                                <td>20-50</td>
                                                 <td>&#8373 9</td>
                                              </tr>
                                               <tr>
                                              <td>Banku and Tilapia</td>
                                                <td>20-50</td>
                                                 <td>&#8373 10</td>
                                              </tr>
                                              <tr>
                                              <td>Fried Rice and chicken</td>
                                                <td>51-200</td>
                                                 <td>&#8373 7</td>
                                              </tr>
                                              <tr>
                                              <td>Fried Rice and Tilapia</td>
                                                <td>51-200</td>
                                                 <td>&#8373 8</td>
                                              </tr>
                                              <tr>
                                              <td>Jollof rice and chicken</td>
                                                <td>51-200</td>
                                                 <td>&#8373 8</td>
                                              </tr>
                                               <tr>
                                              <td>Banku and Tilapia</td>
                                                <td>21-50</td>
                                                 <td>&#8373 9</td>
                                              </tr>
                                          </tbody>
                                          
                                          </table>
                                      </div>
                                  </div>
                                  </div>
                              </div>
                             
                                <div class='row'>
                                  <div class='col-md-4'></div>
                                     <div class='col-md-4'>
                                      <div class='panel panel-primary'>
                                         <div class='panel-heading'>
                                    <h4 class='text-center'>Event Order forms</h4>  
                                             
                                             <?php 
                                             
                                             $message = "";
                                             if(isset($_POST['submit_event'])){
                                                 
                                                $customer_Id =  $_SESSION['cID'];
                                                 $ename = $_POST['ename'];
                                                 $quantity = $_POST['quantity'];
                                                 $fooditem = $_POST['fooditem'];
                                                 $dtime = $_POST['dtime'];
                                                 
                                                 $event_sql = "INSERT INTO event (eventName,fooditems,quantity,deliveryDate,c_ID) VALUES('$ename','$fooditem','$quantity','$dtime','$customer_Id')";
                                                 $event_result = mysqli_query($db,$event_sql);
                                                 if($event_result){
                                                     $message = "
                                                     
                                                           <div class='alert alert-warning'>
                                                          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>You have successfully place event package</p></b>
                                                       </div>
                                                     ";
                                                     
                                                 }else{
                                                     $message = "
                                                      <div class='alert alert-warning'>
                                                          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>failed to add try again</p></b>
                                                       </div>
                                                     
                                                     ";
                                                 }
                                             }
                                             
                                             ?>
                                <form method='post' action="">
                                    
                                    <?php echo $message; ?>
                                 
                                     <div class='form-group'>
                                <label for='eventName'>Event Name</label>
                                <input type='text' name='ename' class='form-control' required>
                            </div>
                             <div class='form-group'>
                                <label for='fooditem'>Food Name</label>
                                <input type="text" name='fooditem' class="form-control" required>
                            </div>
                            <div class='form-group'>
                                <label for='quantity'>quantity</label>
                                <input type='text' name='quantity' class='form-control' required>
                            </div>
                            <div class='form-group'>
                                <label for='date'>Delivery Date and Time</label>
                                <input type='datetime-local' name='dtime' class='form-control' required>
                            </div>
                                <div class='form-group'>
                                
                                <input type='submit' style="width:100%;" class='btn btn-danger btn-lg' name="submit_event" class='form-control' value="placeOrder">
                            </div>
                                    
                                             </form>
                                          
                                          </div>
                                         </div> 
                                   
                                    </div>
                                     <div class='col-md-4'></div>
                                  
                                  </div>
                              
                              </div>
                          </div>    
                          <div class="panel-footer"></div>
                          
                        

                   <!-- <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="img/slide-1.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$24.99</h4>
                                <h4><a href="#">First Product</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                           
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="img/slide-2.jpg" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$64.99</h4>
                                <h4><a href="#">Second Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                           
                        </div>
                          </div> -->

                   
                </div>
    
                
          

            </div>
            

        </div>

    </div>
     <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; MPB andriod App 2018</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
