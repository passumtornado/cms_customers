<?php
session_start();

include "includes/db.php";
$source = $_GET['source'];
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
<div class="address-bar">UENR | SUNYANI-FIAPRE | BEREKUM ROAD</div>
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
                        <a class="active" href="myproduct.php" id="login"><span class="glyphicon glyphicon-"></span>products</a>
                    </li>
                    <li>
                        <a href="customer_cart_edit.php" id="cart_container"><span class="glyphicon glyphicon-shopping-cart"></span>Cart<span class="badge">0</span></a>
                    </li>
                    <li class="dropdown">
                        <a href="index.php?source=signup" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo " <span style='font-size:12; text-transform: lowercase ! important;'>Hi {$_SESSION['customer']} </span>
                              ";?><span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="customer_cart_edit.php" ><span class="glyphicon glyphicon-shopping-cart"></span>MyCart<span class="badge">0</span></a></li>
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
            </div>

            <div class="col-md-9">
                <div class="row">
                  <div class="col-md-12" id="food_msg">
                      
                    </div>
                </div>
                      <div class="panel panel-success">
                          <div class="panel-heading">MENU</div>
                          <div class="panel-body">
                              <div id="view_food">
                             
                                <?php 
                                  
                                  
                        $m_query = "SELECT * FROM menu WHERE m_ID = '$source'";
                        $m_result = mysqli_query($db,$m_query);
                       
                                  
                         if($m_result ) {
                            if (mysqli_num_rows($m_result) > 0) {
                                while ($row = mysqli_fetch_array($m_result)) {
                                    $mID = $row['m_ID'];
                                    $image = $row['image'];
                                    $foodname = $row['foodName'];
                                    $quantity = $row['quantity'];
                                    $price = $row['amount'];
                                    $category = $row['category_ID'];
                                    $time = $row['date'];
                                    $description = $row['description'];

                                    echo "
                                <div class='row'>
                                    <div class='col-md-3'></div>
                                     <div class='col-md-6'>
                            
                                       
                                         
                                        <div class='panel panel-primary'>
                                         <div class='panel-heading'>$foodname</div>
                                         <div class='panel-body'>
                                          <img src='cookUpload/$image' style='width: 200px; height: 250px;'class='img img-thumbnail'>
                                            <p>$description</p>
                                         
                                         </div>
                                     <div class='panel-footer'>&#8373 $price.00
                                            <button m_id='$mID' id='myMenu' style='float: right;' class='btn btn-success btn-xs'>BUY</button>
                                            </div>
                                        </div>
                            
                                   </div>
                                  <div class='col-md-3'></div>
                                    
                                    </div>
                    
                        
        
   
                                  ";

                                }

                            }
                         }
                        ?>




                                  
                               
                              
                              </div>
                          </div>    
                          <div class="panel-footer"><a href="myproduct.php"  class="btn btn-success btn-lg">
                       continue ordering
                   </a></div>
                   
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
    

</body>

</html>


 
