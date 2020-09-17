<?php
session_start();
if(!isset($_SESSION['username'])){
    
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
                        <a class="active" href="index.php?source=login" id="login"><span class="glyphicon glyphicon-"></span>products</a>
                    </li>
                    <li>
                        <a href="index.php?source=login" id="login"><span class="glyphicon glyphicon-shopping-cart"></span>Cart<span class="badge">2</span></a>
                    </li>
                    <li class="dropdown">
                        <a href="index.php?source=signup" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo " <span style='font-size:12; text-transform: lowercase ! important;'>Hi {$_SESSION['username']} </span>
                              ";?><span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span>MyCart</a></li>
                             <li class="divider" role="separator"></li>
                             <li><a href="#"><span class="glyphicon glyphicon-shopping-user"></span>Profile</a></li>
                              <li class="divider" role="separator"></li>
                             <li><a href="#"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
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
                <form method="post" action="">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="search for...">
                        <span class="input-group-btn"><button class="btn btn-success" type="button" name="submit">G0!</button></span>
                    </div>
                </form>
                <p><br/></p>
                <div class="row">
                    <div class="col-md-12">
                         <p class="lead"><a href="product.php?source=menu">MENU</a></p>
                <div class="list-group">
                    <a href="product.php?source=breakfast" class="list-group-item">Breakfast</a>
                    <a href="product.php?source=lunch" class="list-group-item">Lunch</a>
                    <a href="product.php?source=supper" class="list-group-item">Supper</a>
                </div>
                    </div>
                </div>
               
                <div class="row">
                 <p class="lead"><a href="#">SPECIAL OFFERS</a></p>
                    <div class="col-md-12">
                         <div class="list-group">
                    <a href="#" class="list-group-item">Combo</a>
                    <a href="#" class="list-group-item">Event</a>
                    <a href="#" class="list-group-item">Snacks</a>
                </div>
                        
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                      <div class="panel panel-success">
                          <div class="panel-heading">MENU</div>
                          <div class="panel-body">
                              <div class="get_menu">
                             
                              <?php 
     
       if(isset($_POST['submit'])){
           $search = $_POST['search'];
           
           $mquery = "SELECT * FROM menu WHERE foodtags LIKE '%$search%'";
           
           $search_query = mysqli_query($db,$mquery);
          
           
           if(!$search_query){
               die("QUERY FAILED".mysqli_error($db));
           }
           $show = mysqli_num_rows($search_query);
           
           if($show ==0){
               echo "No Results";
               }
           else{
               $query = "SELECT * FROM menu WHERE foodtags LIKE '%$search%'";
               
               $menu_result = mysqli_query($db,$query);
               
               if($menu_result){
             while($row= mysqli_fetch_array($menu_result )){
            $mID = $row['m_ID'];
            $image = $row['image'];
            $foodname = $row['foodName'];
            $quantity = $row['quantity'];
            $price = $row['amount'];
            $category = $row['category_ID'];
            $time = $row['date'];
            $description = $row['description'];

            echo "
<div class='col-md-4'>
   <a href='view.php?source=$mID'>
    <div class='panel panel-info'>
     
        <div class='panel-heading'>$foodname</div> 
        
        <div class='panel-body'>
            <img src='cookUpload/$image' style='width: 200px; height: 250px;'class='img img-thumbnail'>
            <p>$description</p>
        </div>
        <div class='panel-heading'>$ $price.00
            <button id='$mID' style='float: right;' class='btn btn-success btn-xs'>placeOrder</button>
        </div>
        
    </div>
     </a>
</div>
";

        }
                   
               }
           
           }

       
           
           }
       
       
    ?>
     
                              
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

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="img/slide-1.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="img/slide-2.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="img/slide-3.jpg" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

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
    <script type="text/javascript" src="js/main.js"></script>

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



